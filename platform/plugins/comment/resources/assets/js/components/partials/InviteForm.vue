<template>
    <modal :show.sync="show" :on-close="onClose" :loading="isLoading">
        <div slot="header">
            <h3>Invite Someone</h3>
        </div>
        <div class="mt-4" slot="body">
            <div class="form-group" key="email">
                <input
                    v-model="email"
                    :style="errorFlage != 0 ? 'border: 1px solid red;' : ''"
                    placeholder="username@website.com"
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                />
                <small
                    v-if="errorFlage == 1"
                    id="emailHelp"
                    class="form-text text-muted"
                    >{{ errorMessage }}</small
                    >
            </div>
        </div>
        <div
            class="d-block d-sm-flex justify-content-end align-items-center mt-2"
            slot="footer"
        >
            <div>
                <button
                    class="btn btn-warning"
                    type="button"
                    @click="sendEmail"
                >
                    {{ __("SEND") }}
                </button>
            </div>
        </div>
    </modal>
</template>

<script>
import Modal from "./Modal";
import Http from "../../service/http";
import Ls from "../../service/Ls";
import emailjs from 'emailjs-com';

export default {
    name: "InviteForm",
    data: () => {
        return {
            isLoading: false,
            errorFlage: 0,
            errorMessage: "",
            email: "",
        };
    },
    components: {
        modal: Modal,
    },
    props: {
        show: {
            type: Boolean,
            required: true,
            twoWay: true,
        },
        onClose: {
            type: Function,
            required: true,
        },
        emailData: {
            type: Function
        }
    },
    methods: {
        sendEmail() {
            if (this.email == "") {
                this.errorFlage = 1;
                this.errorMessage = "Email is a required field.";
                return;
            } else if (this.email.indexOf("@") === -1) {
                this.errorFlage = 1;
                this.errorMessage = "Email must be include @ symbol";
                return;
            }
            console.log("email", this.email);
            const message = "link: https://flex-home.botble.com" + window.location.pathname;

            try {
                emailjs.init('user_Y2rIG8i4i6tkeu6xn7wos');
                const templateParams = {
                    to_name: this.email,
                    from_name: 'lancakster512@gmail.com',
                    message: message
                };
                emailjs.send('service_l1l0l2j', 'template_ny99ses', templateParams);
                this.onClose();
                this.$toastr.s("Success", "Invite Success to the " + this.email);

            } catch(error) {
                console.log({error})
            }
        },
    },
    inject: ['getUser']
};
</script>

<style scoped>
  .btn-warning {
    background-color: #ED6C02!important;
    color: white!important;
  }
  #emailHelp {
    color: red!important;
  }
</style>
