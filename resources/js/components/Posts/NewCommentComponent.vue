<template>
    <form @submit.prevent="comment">
        <div class="form-group">
            <textarea v-model="body" name="body" id="comment" class="form-control" cols="30" rows="10" :placeholder="trans('lang.comment')" :disabled="disabled" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success" v-text="state" :disabled="disabled"></button>
        </div>
    </form>
</template>

<script>
export default {
    props: ['post'],
    data() {
        return {
            body: '',
            toasterOptions: {
                position: "topRight",
                timeout: 4000
            },
            disabled: false,
        }
    },
    computed: {
        url() {
            return `/posts/${this.post.slug}/comment`;
        },
        state() {
            return this.disabled ? 'loading...' : this.trans('lang.comment');
        }
    },
    methods: {
        showSuccess(message){
            return this.$toast.success(' ', message, this.toasterOptions);
        },
        showError(error){
            return this.$toast.error(' ', error, this.toasterOptions);
        },
        comment() {
            this.disabled = true;
            axios.post(this.url, {body: this.body})
                .then(({ data }) => {
                    if (data.type == 'success') {
                        this.showSuccess(data.message);
                        this.body = '';
                        window.$Events.$emit('new_comment_added', data.comment);
                    } else {
                        this.showError(data.message);
                    }

                    this.disabled = false;
                })
                .catch(({response}) => {
                    if (response.status == '422') { // Validation Error Status Code
                        const errors =  response.data.errors;

                        for(const error in errors) {
                            this.showError(errors[error][0]);
                        }
                    }

                    this.disabled = false;
                });
        }
    }
}
</script>