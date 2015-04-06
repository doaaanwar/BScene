<?php

namespace Acme\bsceneBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Acme\bsceneBundle\Controller\CategoriesController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\BrowserKit\Response;
use PHPMailer;

class DefaultController extends Controller {

    public function indexAction() {
        $categoryList = $this->getCategoryList();

        return $this->render('AcmebsceneBundle:Default:index.html.twig', array('categoryList' => $categoryList));
    }

    private function getCategoryList() {

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder();

        $qb->select('c')->From('AcmebsceneBundle:Categories', 'c')->where('c.ranking != 0')->orderBy('c.ranking', 'DESC');
        $query = $qb->getQuery();

        $categoryList = $query->getResult();

        return $categoryList;
    }

    /**
     * Added by doaa elfayoumi - 22.03.2015 to get the json response for the homepage calender
     * @return \Acme\bsceneBundle\Controller\JsonResponse
     */
    public function getEventsDayListAction() {
        $em = $this->getDoctrine()->getManager();


        $q = $em->createQuery("select Distinct m.date from \Acme\bsceneBundle\Entity\Meeting m");

        $dateList = $q->getResult();

        //transform the result to the format need for the calender

        $dateArray = array();
        $dateArrayEntry = Null;

        foreach ($dateList as $item) {
            $day = $item['date']->format('Y-m-d');


            $url = " ./meeting/eventByDay/$day ";

            $dateArrayEntry = array("date" => $item['date']->format('j/n/Y'), "title" => "event on " . $item['date']->format('Y-m-d'), "link" => $url, "color" => "green");

            $dateArray[] = $dateArrayEntry;
        }

        //encode the array to json
        //removed the encode because it require decode on the page before be used by the calender
        //$dateArray = json_encode($dateArray);
        return $this->render('AcmebsceneBundle:Default:calender.html.twig', array('data' => $dateArray));
    }

    public function loginAction(Request $request) {
        $categoryList = $this->getCategoryList();


        if ($request->getMethod() == 'POST') {
            $session = $request->getSession();
            $session->clear();
            $username = $request->get('username');
            $password = $request->get('password');
            $em = $this->getDoctrine()->getEntityManager();



            $repository = $em->getRepository('\Acme\bsceneBundle\Entity\Account');

            //fetch user by username
            $user = $repository->findOneBy(array('username' => $username));

            //username found
            if ($user) {
                if ($user->getIsVerified() == 1) {
                    $verified = password_verify($password, $user->getPassword());
                    if ($verified) {
                        //$session = new Session();
                        //$session->start();
                        $session->invalidate(5000);
                        $session->set('member', $user->getUsername());
                        $session->set('memberId', $user->getId());
                        if ($user->getIsAdmin() == 1) {

                            $session->set('admin', 'admin');
                            $session->set('lastLogin', $user->getLastLogin());

                            //TODO save the current time for the last login of the admin or do it on the logout
                        } //end if user is admin
                        return $this->render('AcmebsceneBundle:Default:index.html.twig', array('name' => $user->getUsername(), 'categoryList' => $categoryList));
                    } else {   //password doesn't match
                        return $this->render('AcmebsceneBundle:Default:login.html.twig', array('errormessage' => 'incorrect password', 'categoryList' => $categoryList));
                    }
                } else { //user e-mail not validated
                    return $this->render('AcmebsceneBundle:Default:login.html.twig', array('errormessage' => 'You have not yet validated your e-mail address. '
                        . 'Please click the link in the e-mail you received when you registered', 'categoryList' => $categoryList));
                }
            } else { //User not found
                return $this->render('AcmebsceneBundle:Default:login.html.twig', array('errormessage' => 'login failed', 'categoryList' => $categoryList));
            }
        } else { //Post method
            return $this->render('AcmebsceneBundle:Default:index.html.twig', array('categoryList' => $categoryList));
        }
    }

    /**
     * added 25.03.2015 doaa elfayoumi
     * function to logout
     * @param Request $request
     */
    public function logoutAction(Request $request) {
        $session = $request->getSession();
        $session->set('member', null);
        $session->set('memberId', null);
        $session->set('admin', null);
        $session->set('lastLogin', null);
        $categoryList = $this->getCategoryList();
        return $this->render('AcmebsceneBundle:Default:index.html.twig', array('categoryList' => $categoryList));
    }

    public function showPasswordReminderAction() {
        $message = "Enter your e-mail address and we'll send it to you:";
        return $this->render('AcmebsceneBundle:Default:passwordReminder.html.twig', array('message' => $message));
    }

    private function setTempPassword($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmebsceneBundle:Account')->find($id);
        $tempPassword = \uniqid();
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($entity, $tempPassword);
        $entity->setPassword($encoded);
        $em->persist($entity);
        $em->flush();
        return $tempPassword;
    }

    public function passwordReminderAction(Request $request) {
        $email = $this->get('request')->request->get('passwordReminder');

        $em = $this->getDoctrine()->getManager();

        $q = $em->createQuery("SELECT a "
                        . "FROM \Acme\bsceneBundle\Entity\Account a "
                        . "WHERE a.email = :email")->setParameter('email', $email);
        $user = $q->getArrayResult();


        if ($user != null) {
            $emailReminder = $user[0]['email'];
            $id = $user[0]['id'];

            $tempPassword = $this->setTempPassword($id);
            $username = $user[0]['username'];

            $options = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'bscenenetwork@gmail.com';                 // SMTP username
            $mail->Password = 'sustento';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->From = 'bscenenetwork@gmail.com';
            $mail->FromName = 'B-Scene';
            $mail->addAddress($emailReminder);     // Add a recipient



            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'B-Scene Password Reminder';
            $mail->Body = 'We have reset your password. Your B-Scene username and password are as follows: <br><br> '
                    . '<b>Username:</b> ' . $username . ' <br>'
                    . '<b>Password:</b> ' . $tempPassword . ' <br>'
                    . 'You can change your password after logging in from the edit profile page. <br><br>'
                    . 'Regards, <br> B-Scene Team';
            $mail->AltBody = 'Your B-Scene username and password are as follows: '
                    . 'Username: ' . $username
                    . ' Password: ' . $tempPassword
                    . ' Regards, B-Scene Team';

            $mail->smtpConnect($options);

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $message = 'Message has been sent';
            }
            return $this->render('AcmebsceneBundle:Default:passwordReminder.html.twig', array('message' => $message,));
        } else {
            $message = 'We do not have record of that e-mail address. Please try again, or create an account.';
            return $this->render('AcmebsceneBundle:Default:passwordReminder.html.twig', array('message' => $message,));
        }
    }

    public function contactAction() {
        return $this->render('AcmebsceneBundle:Default:contact.html.twig');
    }

    public function aboutAction() {
        return $this->render('AcmebsceneBundle:Default:about.html.twig');
    }

}
