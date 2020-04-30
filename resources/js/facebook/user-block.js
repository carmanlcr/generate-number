if($('#blockFacebook').length){
    new Vue({

            el: '#blockFacebook',

            created: function(){
                this.getPostUsers();
            },

            data: {
            
                facebook: []

            },

            methods: {
                getPostUsers: function(){
                    if($('#blockFacebook').length){
                        var urlGenerate = '/facebook/block-user';
                    axios.get(urlGenerate)
                    .then(response => {
                        $('#rowHidden').hide();
                        
                        this.facebook = response.data
                    }).catch(response => {
                        $('#rowHidden').hide();
                        console.log(response);

                    });
                    }
                    
                },

            },
            watch: {
                getWatch: function(){
                    this.getPostUsers();
                }
            }

        
    });
}