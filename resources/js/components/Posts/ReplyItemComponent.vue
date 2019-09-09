<template>
    <div>
        <!-- Card Edit -->
        <div class="card bg-light mb-4"  v-if="editing">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div v-text="reply.creator.first_name + ' ' + trans('reply')"></div>
                <div v-text="ago"></div>
            </div>

            <div class="card-body">    
                <div class="form-group">
                    <textarea v-model="body" name="body" id="reply" class="form-control" cols="30" rows="10" :placeholder="trans('lang.reply')" :disabled="editDisabled" required></textarea>
                </div>
            </div>
            
            <div class="card-footer text-right">
                <button type="button" @click.prevent="update" class="btn btn-success" :disabled="editDisabled" v-text="editState"></button>
                <button type="button" @click.prevent="cancel" class="btn btn-danger" :disabled="editDisabled" v-text="trans('lang.cancel')"></button>
            </div>
        </div>

        <!-- Card View -->
        <div class="card mb-4" v-else>
            <div class="card-header d-flex justify-content-between align-items-center">
                <div v-text="reply.creator.first_name + ' ' + trans('reply')"></div>
                <div v-text="ago"></div>
            </div>

            <div class="card-body">
                <p class="card-text" v-text="replyItem.body"></p>
            </div>
            
            <div v-if="($authorize('owns', replyItem) || $authorize('owns', comment)) && $signedIn">
                <div class="card-footer text-right">        
                    <button @click.prevent="edit" class="btn btn-primary" v-text="trans('lang.edit')"></button>
                    <button @click.prevent="remove" class="btn btn-danger" :disabled="disabled" v-text="removeState"></button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import moment from 'moment';

export default {
    props: ['reply', 'comment'],
    data() {
        return {
            replyItem: this.reply,
            disabled: false,
            editDisabled: false,
            editing: false,
            body: '',
            toasterOptions: {
                position: "topRight",
                timeout: 4000
            },
        }
    },
    computed: {
        ago () {
            return moment(this.replyItem.created_at).fromNow() + ' ...';
        },
        url() {
            return `/comments/${this.comment.id}/replies/${this.replyItem.id}`;
        },
        removeState() {
            return this.disabled ? 'deleting...' : this.trans('lang.delete');
        },
        editState() {
            return this.editDisabled ? 'updating...' : this.trans('lang.update');
        }
    },
    mounted() {
        
    },
    methods: {
        showSuccess(message){
            return this.$toast.success(' ', message, this.toasterOptions);
        },
        showError(error){
            return this.$toast.error(' ', error, this.toasterOptions);
        },
        edit() {
            this.editing = true;
            this.body = this.replyItem.body;
        },
        cancel() {
            this.editing = false;
            this.body = '';
        },
        update() {
            this.editDisabled = true;
            axios.patch(this.url, {body: this.body})
                .then(({ data }) => {
                    if (data.type == 'success') {
                        this.showSuccess(data.message);
                        this.replyItem.body = this.body;
                        this.cancel();
                    } else {
                        this.showError(data.message);
                    }

                    this.editDisabled = false;
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
        remove() {
            this.disabled = true;
            axios.delete(this.url)
                .then(({ data }) => {
                  
                  if (data.type == 'success') {
                        this.showSuccess(data.message);
                        window.$Events.$emit('reply_removed', this.replyItem);
                    } else {
                        this.showError(data.message);
                    }

                    this.disabled = false;
                });
        }
    }
}
</script>