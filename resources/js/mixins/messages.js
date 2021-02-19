export default {
    data() {
        return {}
    },
    methods : {
        success(message) {
            this.$emit('success', message);
        },
        error(message) {
            console.log(message);   
        }
    }
}