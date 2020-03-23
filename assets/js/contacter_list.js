$('#myform').submit(function(){
		$.ajax({
			type: "POST",
			url: 'assets/ajax/ajax_contacter.php',  //fichier json
			data: $('form').serialize(),
			success: function (result) {
				if (result === 'ok') {
					echo('Votre message a bien été envoyé');
				} else {
					echo("rebelotez")
				}
			},
			/*error: function (){
				toastr.error("Erreur d'envoi");
			},*/
		});     
	});