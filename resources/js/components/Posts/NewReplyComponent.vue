<template>
        <!-- Card Edit -->
        <div class="card ml-5 mb-4">

            <div class="card-body">    
                <div class="form-group">
                    <textarea v-model="body" name="body" id="reply" class="form-control" cols="30" rows="10" :placeholder="trans('lang.reply')" :disabled="disabled" required></textarea>
                </div>
            </div>
            
            <div class="card-footer text-right">
                <button type="button" @click.prevent="reply" class="btn btn-success" v-text="state" :disabled="disabled"></button>
                <button type="button" @click.prevent="cancelReply" class="btn btn-danger" :disabled="disabled" v-text="trans('lang.cancel')"></button>
            </div>
        </div>
</template>

<script>
export default {
    props: ['comment'],
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
            return `/comments/${this.comment.id}/reply`;
        },
        state() {
            return this.disabled ? 'loading...' : this.trans('lang.reply');
        }
    },
    methods: {
        showSuccess(message){
            return this.$toast.success(' ', message, this.toasterOptions);
        },
        showError(error){
            return this.$toast.error(' ', error, this.toasterOptions);
        },
        reply() {
            this.disabled = true;
            axios.post(this.url, {body: this.body})
                .then(({ data }) => {
                    
                    if (data.type == 'success') {
                        window.$Events.$emit('new_reply_added', data.reply);
                        this.showSuccess(data.message);
                        this.cancelReply();
                        this.body = '';
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
        },
        cancelReply() {
            this.$parent.startReply = false;
        }
    }
}
</script>