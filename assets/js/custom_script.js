let root = new Vue({
    el : '#root',
    data : {
        users : [],
        user : {
            name : "",
            email : "",
            cell : "",
            photo : "",
            location : "",
            gander : ""
        },
        single_user : {
            name : "",
            email : "",
            cell : "",
            photo : ""
        },
        edit_user : {
            name : "",
            id : "",
            email : "",
            cell : "",
            photo : "",
            location : "",
            gander : ""
        },
        search : "",
        localtion : "",
        gander : "",
    },
    methods : {
        //get all user
        getAllUser : function(){
            axios.get('inc/user.php?action=read').then(function(response){
               root.users = response.data;
            })
        },

        //add New user
        addNewUser : function(){
            if( root.user.name == '' || root.user.email == '' || root.user.cell == '' ){
               alert('fill must br Empty!');
            }else{

                root.user.photo = root.$refs.photo.files[0];
                
                let userData = new FormData();

                userData.append('name', root.user.name);
                userData.append('email', root.user.email);
                userData.append('cell', root.user.cell);
                userData.append('photo', root.user.photo);
                userData.append('location', root.user.location);
                userData.append('gander', root.user.gander);

                axios.post('inc/user.php?action=create', userData, {
                    header : {
                        'Content-Type' : 'multipart/form-data'
                    }
                }).then(function(response){
                    root.user.name = "",
                    root.user.email = "",
                    root.user.cell = "",
                    root.getAllUser();
                })
            }
        },

        //delete user methods
        deleteUser : function(id, event){

            event.preventDefault();
            let con = confirm('Are You Sure');
            
            if(con){
                axios.get('inc/delete.php?action=delete&id=' + id).then(function(response){
                   root.getAllUser();
                })
            }else{
              alert('Your Data is Safe!')
            }
        },

        //show single user
        showSingleUser : function(id, event){
            event.preventDefault();
            axios.get('inc/user.php?action=singleData&id=' + id).then(function(response){
                root.single_user.name = response.data.name;
                root.single_user.email = response.data.email;
                root.single_user.cell = response.data.cell;
                root.single_user.photo = response.data.photo
            });
        },

        //Search User For Table
        searchData : function(){
            let search_text = root.search;
            axios.get('inc/user.php?action=search&search=' + search_text).then(function(response){
               root.users = response.data;
            });
        },

        //location Search 
        LocationSearch : function(){
           let location = root.localtion;
           axios.get('inc/user.php?action=locationSearch&location=' + location).then(function(response){
               root.users = response.data;
           });
        },

        //Gander Search 
        GanderSearch : function(){
            let gander_value = root.gander;
            axios.get('inc/user.php?action=Gander&gander=' + gander_value).then(function(response){
                root.users = response.data;
            });
        },

        //editSingleUser form Database
        editSingleUser : function(id, event){
            event.preventDefault();
            axios.get('inc/user.php?action=edit&id=' + id).then(function(response){
               root.edit_user.name = response.data.name;
               root.edit_user.email = response.data.email;
               root.edit_user.id = response.data.id;
               root.edit_user.cell = response.data.cell;
               root.edit_user.location = response.data.location;
               root.edit_user.gander = response.data.gander;
               root.edit_user.photo = response.data.photo;
            });
        },

        //updateSingleUser form Database
        updateSingleUser : function(id, event){
            event.preventDefault();

            let formUpdateData = new FormData();

            formUpdateData.append('name', this.edit_user.name);
            formUpdateData.append('email', this.edit_user.email);
            formUpdateData.append('cell', this.edit_user.cell);
            formUpdateData.append('location', this.edit_user.location);
            formUpdateData.append('gander', this.edit_user.gander);
            // formUpdateData.append('photo', this.edit_user.newPhoto);
            
            //axios request form Database
            axios.post('inc/user.php?action=update&id=' + id, formUpdateData, {
                header : {
                    'Content-Type' : 'multipart/form-data'
                }
            }).then(function(response){
                root.getAllUser();
            });
        },
    },
    created : function(){
        this.getAllUser();
    },
    mounted : function(){

    }
});