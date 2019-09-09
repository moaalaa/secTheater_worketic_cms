<template>
    <div>
        <!-- Card Edit -->
        <div class="card mb-4"  v-if="editing">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div v-text="commentItem.creator.first_name + ' ' + trans('lang.comment')"></div>
                <div v-text="ago"></div>
            </div>

            <div class="card-body">    
                <div class="form-group">
                    <textarea v-model="body" name="body" id="comment" class="form-control" cols="30" rows="10" :placeholder="trans('lang.comment')" :disabled="editDisabled" required></textarea>
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
                <div v-text="commentItem.creator.first_name + ' ' + trans('lang.comment')"></div>
                <div v-text="ago"></div>
            </div>

            <div class="card-body">
                <p class="card-text" v-text="commentItem.body"></p>
            </div>
            
            <div v-if="$signedIn" class="card-footer d-flex justify-content-between align-items-center">
                <button @click.prevent="reply" class="btn btn-success" v-text="trans('lang.reply')"></button>
                
                <div v-if="$authorize('owns', commentItem)">
                    <button @click.prevent="edit" class="btn btn-primary" v-text="trans('lang.edit')"></button>
                    <button @click.prevent="remove" class="btn btn-danger" :disabled="disabled" v-text="removeState"></button>
                </div>
            </div>
        </div>

        <new-reply v-if="startReply && $signedIn" :comment="commentItem"></new-reply>
        <replies-list :comment="commentItem" :replies="commentItem.replies"></replies-list>

    </div>
</template>

<script>
import moment from 'moment';
import RepliesList from "./RepliesListComponent";
import NewReply from "./NewReplyComponent";

export default {
    props: ['comment', 'post'],
    components: {
        RepliesList,
        NewReply,
    },
    data() {
        return {
            commentItem: this.comment,
            disabled: false,
            editDisabled: false,
            editing: false,
            body: '',
            startReply: false,
            toasterOptions: {
                position: "topRight",
                timeout: 4000
            },
        }
    },
    computed: {
        ago () {
            return moment(this.commentItem.created_at).fromNow() + ' ...';
        },
        url() {
            return `/posts/${this.post.slug}/comments/${this.commentItem.id}`;
        },
        removeState() {
            return this.disabled ? 'deleting...' : this.trans('lang.delete');
        },
        editState() {
            return this.editDisabled ? 'updating...' : this.trans('lang.update');
        }
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
            this.body = this.commentItem.body;
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
                        this.commentItem.body = this.body;
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
                        window.$Events.$emit('comment_removed', this.commentItem);
                    } else {
                        this.showError(data.message);
                    }

                    this.disabled = false;
                });
        },
        reply() {
            this.startReply = true;
        }
    }
}
</script>