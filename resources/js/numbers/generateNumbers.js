$('#alert').hide();
if($('#generate').length){
    
    new Vue({

            el: '#generate',

            created: function(){
                this.getGenerate();
                this.getNumbersGenerate();
            },

            data: {
            
                generate: []

            },

            methods: {
                getGenerate: function(){
                    if($('#generate').length){
                        var urlGenerate = '/callcenter/generador';
                    axios.get(urlGenerate)
                    .then(response => {
                        this.generate = response.data
                    }).catch(response => {
                        console.log(response);

                    });
                    }
                    
                },

                getNumbersGenerate: function(){
                    let urlGenerate = '/callcenter/generador-automatico';
                    axios.get(urlGenerate)
                    .then(response => {
                        
                        var alert = $('#alert');
                        alert.show();
                        alert.addClass("alert-"+response.data.status);
                        alert.text(response.data.response);
                        sleep(2500);
                        location.reload();
                    }).catch(response => {
                        location.reload();

                    });
                    
                    
                }

            },

            watch: {
                getWatch: function(){
                    this.getGenerate();
                    this.getNumbersGenerate();
                }
            }

        
    });
}