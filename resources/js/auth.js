

new Vue({

	el: '#app_login',

	data: {
		email: '',
		password: ''
	},

	methods: {

		login: function(){

			axios.post('/login', {
				email: this.email,
				password: this.password
			}).then(error => {
				console.log("Response ");
				swal({
					title: 'Has Iniciado Sesión',
					text: 'Datos Correctos',
					icon: 'success',
					closeOnClickOutside: false,
					claseOnEsc: false
				});
			}).catch(response => {
				console.log("Error "+error.response.data);
				let er = error.response.data.errors;
				let mensaje = "Error no especificado";
				if(er.hasOwnProperty('email')){
					mensaje = er.email[0];
				} else if(er.hasOwnProperty('password')){
					mensaje = er.password[0];
				}else if(er.hasOwnProperty('password')){
					mensaje = er.login[0];
				}

				swal('Error',mensaje,'error');

			});
		}

	}

});