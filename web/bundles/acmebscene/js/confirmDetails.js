function registerSubmitHandler(formId){
	$("form#" + formId + " button#submitProfile").click(function(){
		$("form#" + formId).find("input, select").each(function (){
			var id = $(this).attr("id");
			var value;

			if ($(this).prop("tagName").toLowerCase() == "select")
			{
				value = $(this).find("option:selected").text();
			}
			else
			{
				value = $(this).val();
			}
			$("#confirmDetails #" + id).text(value);
		});

	});
};