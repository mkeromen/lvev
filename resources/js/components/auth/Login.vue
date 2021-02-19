<template>
    <div class="login-form">
        <div class="alert alert-danger" role="alert" v-if="errorMessage != ''">
            {{ errorMessage }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="username" id="username" class="form-control" v-model="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" v-model="password">
            </div>

            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</template>

<script>
import Api from './../../mixins/api.js';

export default {
    data() {
        return {
            username: '',
            password: '',
            errorMessage: ''
        }
    },
    methods: {
        login() {
            var $this = this;
            this.api('/api/login', {
                username: this.username,
                password: this.password
            }).post(function(response) {
                $this.$emit('success', response.data);
            }, function(error) {
                $this.errorMessage = error.response.data.message;
            });
        }
    },
    mixins: [Api]
}
</script>