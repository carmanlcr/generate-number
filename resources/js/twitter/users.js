
if($('#usersTwitter').length){

    new Vue({

        el: '#usersTwitter',

            created: function(){
                this.getUsers();
            },

            data: {
            
                twitter: [],
                pagination: [],
                url: '/api/twitter/users',
                search: ''
            },

            computed: {
                filteredEnqueries(){

                    return this.twitter.filter(user => {
                        return user.username.toLowerCase().includes(this.search.toLowerCase()) || 
                        user.email.toLowerCase().includes(this.search.toLowerCase()) || 
                        user.full_name.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.password.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.date_of_birth.includes(this.search) ||
                        user.vpn.toLowerCase().includes(this.search.toLowerCase()) ||
                        user.categories.toLowerCase().includes(this.search.toLowerCase());
                    });
                }
            },

            methods: {
                getUsers: function(){
                    if($('#usersTwitter').length){
                    axios.get(this.url)
                    .then(response => {
                        $('#rowHidden').hide();
                        this.twitter = response.data.users.data;
                        this.pagination = response.data.users;
                    }).catch(response => {
                        $('#rowHidden').hide();
                        console.log(response);

                    });
                    }
                    
                },

                makePagination(data){
                    let pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url
                    }

                    this.pagination = pagination;
                },

                fetchPaginateUsers(url){
                    this.url = url;
                    this.getUsers();
                }

            },
            watch: {
                getWatch: function(){
                    this.getUsers();
                }
            }
    });
}