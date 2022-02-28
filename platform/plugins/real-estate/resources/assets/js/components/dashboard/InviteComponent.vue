<template>
    <div class="bb-comment-header">        
        <div class=title>
            <h3 class="modal-title" id="inviteModalLabel">Invite Someone to your Circle</h3>
        </div>
        <div>
            <form>
                <div class="form-group">                    
                    <input v-model="email" :style="errorFlage == 1 || errorFlage == 2 ? 'border: 1px solid red;' : ''" placeholder="Please enter a vaild email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small v-if="errorFlage == 1" id="emailHelp" class="form-text text-muted">{{errorMessage}}</small>
                </div>
            </form>
        </div>
        <div id="invite">            
            <button type="button" class="btn btn-warning" @click="sendEmail">SEND</button>
        </div>        
        <notifications group="foo" />        
    </div>
</template>

<script>
import emailjs from 'emailjs-com';

export default {
    name: 'Header',
    
    data: () => {
        return {
            errorFlage: 0,
            errorMessage: '',
            email: '',
            username: '',
            useremail: ''
        }
    },
    methods: {
        async sendEmail () {
            if (this.email == '') {
                this.errorFlage = 1;
                this.errorMessage = 'Email is a required field.';
                return false;
            }
            else if (this.email.indexOf('@') === -1) {
                this.errorFlage = 1;
                this.errorMessage = 'Email must be include @ symbol';
                return false;
            }            
            
            try{
                emailjs.init('user_bgx5rwuEbN6ynONqOjDYT')
                await emailjs.send('service_e5pmxd9', 'template_a33zlly',{                
                    to_email: this.email,
                    to_name: document.URL,
                    from_email: this.user.email,
                    from_name: this.user.first_name+' '+this.user.last_name
                })
                this.$notify({
                    group: 'foo',
                    title: 'Invite to',
                    type: 'success',
                    text: this.email
                });                
            } catch (error){                
                this.$notify({
                    group: 'foo',
                    title: 'Failed!',
                    type: 'warn',
                    text: this.email
                });                
            }            
        },
    },
    props:['user']
}
</script>
<style scoped>  
  .title {
    padding-bottom: 10px;
    margin-bottom: 20px;
    border-bottom: 1px solid lightgray;
  }
  .btn-warning {
    background-color: #ED6C02!important;
    color: white!important;
  }  
  #invite {
      margin: 20px 0;
  }
</style>

