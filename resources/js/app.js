/**
 * Load all the javascript by using Vue.js and write all your JS code
 * in this file.
 */

require('./bootstrap');
import BootstrapVue from 'bootstrap-vue';
import 'izitoast/dist/css/iziToast.css';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
import Verte from 'verte';
import 'verte/dist/verte.css';
import Vue from 'vue';
import datePicker from 'vue-bootstrap-datetimepicker';
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead';
import 'vue-date-pick/dist/vueDatePick.css';
import VueIziToast from 'vue-izitoast';
import SmoothScrollbar from 'vue-smooth-scrollbar';
import { VueStars } from "vue-stars";
import VueSweetalert2 from 'vue-sweetalert2';
import * as VueGoogleMaps from 'vue2-google-maps';
import Vuebar from 'vuebar';
import '../../public/js/tinymce/tinymce.min.js';
import Event from './event.js';

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};

Vue.filter('two_digits', function (value) {
    if (value.toString().length <= 1) {
        return "0" + value.toString();
    }
    return value.toString();
});

Vue.use(VueGoogleMaps, {
    load: {
        key: Map_key,
        libraries: 'places',
    },
})
Vue.use(VueIziToast);
Vue.use(SmoothScrollbar)
Vue.use(VueSweetalert2);
Vue.use(Vuebar);

window.Vue = require('vue');
window.flashVue = new Vue();
window.deleteVue = new Vue();
window.flashMessageVue = new Vue();
window.$Events = new Vue();

Vue.use(datePicker);
Vue.use(BootstrapVue);

let authorizations = require('./authorization');

Vue.prototype.$authorize = function (...params) {
	if (!window.App.signedIn) return false;

	if (typeof params[ 0 ] === 'string') {
		return authorizations[ params[ 0 ] ](params[ 1 ])
	}

	return params[ 0 ](window.App.user);
};

Vue.prototype.$signedIn = window.App.signedIn;


// ---------------------------  Posts -----------------------------

Vue.component('comments-list', require('./components/Posts/CommentsListComponent.vue').default);
Vue.component('new-comment', require('./components/Posts/NewCommentComponent.vue').default);

// --------------------------- End Posts --------------------------

Vue.component('verte', Verte);
Vue.component('upload-file', require('./components/UploadFileComponent.vue').default);
Vue.component('upload-image', require('./components/UploadImageComponent.vue').default);
Vue.component('flash_messages', require('./components/FlashMessages.vue').default);
Vue.component('switch_button', require('./components/SwitchButton.vue').default);
require('./components/FlashMessageComponent.vue').default
Vue.component("vue-stars", VueStars)
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)
Vue.component('emoji-textarea', require('./components/emojiTexeareaComponent.vue').default);
Vue.component('delete', require('./components/DeleteRecordComponent.vue').default);
Vue.component('dashboard-icon', require('./components/DashboardIconUploadComponent.vue').default);
Vue.component('image-attachments', require('./components/UploadServiceAttachmentComponent.vue').default);


jQuery(document).ready(function () {
    jQuery(document).on('click', '.wt-back', function (e) {
        e.preventDefault();
        jQuery('.wt-back').parents('.wt-messages-holder').removeClass('wt-openmsg');
    });

    jQuery(document).on('click', '.wt-respsonsive-search', function (e) {
        e.preventDefault();
        jQuery('.wt-headervtwo').addClass('wt-search-have show-sform');
    });

    jQuery(document).on('click', '.wt-search-remove', function (e) {
        e.preventDefault();
        jQuery('.wt-search-have').removeClass('show-sform');
    })

    jQuery(document).on('click', '.wt-ad', function (e) {
        e.preventDefault();
        jQuery('.wt-ad').parents('.wt-messages-holder').addClass('wt-openmsg');
    });
    jQuery('.wt-navigation ul li.menu-item-has-children, .wt-navdashboard ul li.menu-item-has-children').prepend('<span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>');
    jQuery('.wt-navigation ul li.menu-item-has-children span').on('click', function () {
        jQuery(this).parent('li').toggleClass('wt-open');
        jQuery(this).next().next().slideToggle(300);
    });

    jQuery('.wt-navigation ul li.menu-item-has-children > a, .wt-navigation ul li.page_item_has_children > a').on('click', function () {
        if (location.href.indexOf("#") != -1) {
            jQuery(this).parent('li').toggleClass('wt-open');
            jQuery(this).next().slideToggle(300);
        } else {
            //do nothing
        }
    });

    jQuery('.wt-navdashboard ul li.menu-item-has-children').on('click', function () {
        jQuery(this).toggleClass('wt-open');
        jQuery(this).find('.sub-menu').slideToggle(300);
    });


    function fixedNav() {
        $(window).scroll(function () {
            var $pscroll = $(window).scrollTop();
            if ($pscroll > 76) {
                $('.wt-sidebarwrapper').addClass('wt-fixednav');
            } else {
                $('.wt-sidebarwrapper').removeClass('wt-fixednav');
            }
        });
    }
    fixedNav();

    jQuery('.filter-records').on('keyup', function () {
        var content = jQuery(this).val();
        console.log(content);
        jQuery(this).parents('fieldset').siblings('fieldset').find('.wt-checkbox:contains(' + content + ')').show();
        jQuery(this).parents('fieldset').siblings('fieldset').find('.wt-checkbox:not(:contains(' + content + '))').hide();
    });

    jQuery('#wt-btnclosechat, #wt-getsupport').on('click', function () {
        jQuery('.wt-chatbox').slideToggle();
    });

    if (jQuery('.wt-verticalscrollbar').length > 0) {
        var _wt_verticalscrollbar = jQuery('.wt-verticalscrollbar');
        _wt_verticalscrollbar.mCustomScrollbar({
            axis: "y",
        });
    }

    jQuery('#wt-loginbtn, .wt-loginheader a').on('click', function (event) {
        event.preventDefault();
        jQuery('.wt-loginarea .wt-loginformhold').slideToggle();
    });

    if (jQuery('#wt-btnmenutoggle').length > 0) {
        jQuery("#wt-btnmenutoggle").on('click', function (event) {
            event.preventDefault();
            jQuery('#wt-wrapper').toggleClass('wt-openmenu');
            jQuery('body').toggleClass('wt-noscroll');
            jQuery('.wt-navdashboard ul.sub-menu').hide();
        });
    }

    tinymce.init({
        selector: 'textarea.wt-tinymceeditor',
        height: 300,
        theme: 'modern',
        plugins: ['code advlist autolink lists link image charmap print preview hr anchor pagebreak'],
        menubar: false,
        statusbar: false,
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify code',
        image_advtab: true,
        remove_script_host: false,
    });

});


// -------------------------------- Posts Vue ---------------------------------
if (document.getElementById("posts-app")) {
    new Vue({
        el: '#posts-app',
        mounted: function () {
            console.log('Mounted POsts App');
        },
    });
}
// -------------------------------- End Posts Vue ------------------------------

if (document.getElementById("wt-header")) {
    const vmHeader = new Vue({
        el: '#wt-header',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
    });
}


if (document.getElementById("dashboard")) {
    const VueDashboard = new Vue({
        el: '#dashboard',
        mounted: function () { },
        data: {},
        methods: {}
    });
}

if (document.getElementById("home")) {
    const vmstripePass = new Vue({
        el: '#home',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        data: {
            show: false,
        },
        methods: {}
    });
}

if (document.getElementById("registration")) {
    const registration = new Vue({
        el: '#registration',
        mounted: function () {

        },
        data: {
            notificationSystem: {
                options: {
                    error: {
                        position: "topRight",
                        timeout: 4000
                    }
                }
            },
            step: 1,
            user_email: '',
            first_name: '',
            last_name: '',
            form_step1: {
                email_error: '',
                is_email_error: false,
                first_name_error: '',
                is_first_name_error: false,
                last_name_error: '',
                is_last_name_error: false,
            },
            form_step2: {
                locations_error: '',
                is_locations_error: false,
                password_error: '',
                is_password_error: false,
                password_confirm_error: '',
                is_password_confirm_error: false,
                termsconditions_error: '',
                is_termsconditions_error: false,
            },
            loading: false,
            user_role: 'employer',
            is_show: true,
            error_message: ''
        },
        methods: {
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            prev: function () {
                this.step--;
            },
            next: function () {
                this.step++;
            },
            selectedRole: function (role) {
                // if (role == 'employer') {
                //     this.is_show = true;
                // } else {
                //     this.is_show = false;
                // }
                // console.log(role);
            },
            checkStep1: function (e) {
                this.form_step1.first_name_error = '';
                this.form_step1.is_first_name_error = false;
                this.form_step1.last_name_error = '';
                this.form_step1.is_last_name_error = false;
                this.form_step1.email_error = '';
                this.form_step1.is_email_error = false;
                var self = this;
                let register_Form = document.getElementById('register_form');
                let form_data = new FormData(register_Form);
                axios.post(APP_URL + '/register/form-step1-custom-errors', form_data)
                    .then(function (response) {
                        self.next();
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.first_name) {
                            self.form_step1.first_name_error = error.response.data.errors.first_name[0];
                            self.form_step1.is_first_name_error = true;
                        }
                        if (error.response.data.errors.last_name) {
                            self.form_step1.last_name_error = error.response.data.errors.last_name[0];
                            self.form_step1.is_last_name_error = true;
                        }
                        if (error.response.data.errors.email) {
                            self.form_step1.email_error = error.response.data.errors.email[0];
                            self.form_step1.is_email_error = true;
                        }
                    });
            },
            checkStep2: function (error_message) {
                this.error_message = error_message;
                let register_Form = document.getElementById('register_form');
                let form_data = new FormData(register_Form);
                this.form_step2.password_error = '';
                this.form_step2.is_password_error = false;
                this.form_step2.password_confirm_error = '';
                this.form_step2.is_password_confirm_error = false;
                this.form_step2.termsconditions_error = '';
                this.form_step2.is_termsconditions_error = false;
                var self = this;
                axios.post(APP_URL + '/register/form-step2-custom-errors', form_data).
                    then(function (response) {
                        self.submitUser();
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.password) {
                            self.form_step2.password_error = error.response.data.errors.password[0];
                            self.form_step2.is_password_error = true;
                        }
                        if (error.response.data.errors.password_confirmation) {
                            self.form_step2.password_confirm_error = error.response.data.errors.password_confirmation[0];
                            self.form_step2.is_password_confirm_error = true;
                        }
                        if (error.response.data.errors.termsconditions) {
                            self.form_step2.termsconditions_error = error.response.data.errors.termsconditions[0];
                            self.form_step2.is_termsconditions_error = true;
                        }
                    });
            },
            submitUser: function () {
                this.loading = true;
                let register_Form = document.getElementById('register_form');
                let form_data = new FormData(register_Form);
                form_data.append('email', this.user_email);
                form_data.append('first_name', this.first_name);
                form_data.append('last_name', this.last_name);
                var self = this;
                axios.post(APP_URL + '/register', form_data)
                    .then(function (response) {
               
                        self.loading = false;
                        if (response.data.type == 'success') {
                            if (response.data.email == 'not_configured') {
                                window.location.replace(response.data.url);
                            } else {
                                self.next();
                            }
                        } else if (response.data.type == 'error') {
                            self.loading = false;
                            self.custom_error = true;
                            if (response.data.email_error) self.form_errors.push(response.data.email_error);
                            if (response.data.password_error) self.form_errors.push(response.data.password_error);
                        }
                        else if (response.data.type == 'server_error') {
                            self.loading = false;
                            self.custom_error = true;
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status == 500) {
                            self.showError(self.error_message);
                        }
                    });
            },
            // verifyCode: function () {
            //     this.loading = true;
            //     let register_Form = document.getElementById('verification_form');
            //     let form_data = new FormData(register_Form);
            //     var self = this;
            //     axios.post(APP_URL + '/register/verify-user-code', form_data)
            //         .then(function (response) {
            //             self.loading = false;
            //             if (response.data.type == 'success') {
            //                 self.next();
            //             } else if (response.data.type == 'error') {
            //                 self.showError(response.data.message);
            //             }
            //         })
            //         .catch(function (error) {
            //             console.log(error);
            //         });
            // },
            loginRegisterUser: function () {
                var self = this;
                axios.post(APP_URL + '/register/login-register-user')
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            window.location.href = APP_URL + '/posts';
                        } else if (response.data.type == 'error') {
                            self.error_message = response.data.message;
                        }
                    });
            },
            scrollTop: function () {
                var _scrollUp = jQuery('html, body');
                _scrollUp.animate({ scrollTop: 0 }, 'slow');
                jQuery('.wt-loginarea .wt-loginformhold').slideToggle();
            },
        }
    });
}

if (document.getElementById("pass-reset")) {
    const vmpassReset = new Vue({
        el: '#pass-reset',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        data: {},
        methods: {}
    });
}

if (document.getElementById("post-list")) {
    const vmpostList = new Vue({
        el: '#post-list',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        data: {
            uploaded_image: false,
            color: '',
            rgb: '',
            wheel: '',
            is_show: false
        },
        components: { Verte },
        methods: {
            removeImage: function (id) {
                this.uploaded_image = true;
                document.getElementById(id).value = '';
            },
            selectAll: function () {
                this.is_show = !this.is_show;
                jQuery("#wt-posts").change(function () {
                    jQuery("input:checkbox").prop('checked', jQuery(this).prop("checked"));
                });
            },
            selectRecord: function () {
                if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
                    this.is_show = true;
                } else {
                    this.is_show = false;
                }
            },
            deleteChecked: function (msg, text, url, redirectUrl) {
                var deleteIDs = jQuery("#checked-val input:checkbox:checked").map(function () {
                    return jQuery(this).val();
                }).get();
                
                var self = this;
                this.$swal({
                    title: msg,
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        axios.post(url, {
                            ids: deleteIDs
                        })
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    setTimeout(function () {
                                        self.$swal({
                                            title: this.title,
                                            text: text,
                                            type: "success"
                                        })
                                    }, 500);
                                    window.location.replace(redirectUrl);
                                } else {
                                    self.showError(response.data.message);
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            }
        }
    });
}

if (document.getElementById("lang-list")) {
    const vmdptList = new Vue({
        el: '#lang-list',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        data: {
            langID: "",
            is_show: false
        },
        methods: {
            selectAll: function () {
                this.is_show = !this.is_show;
                jQuery("#wt-langs").change(function () {
                    jQuery("input:checkbox").prop('checked', jQuery(this).prop("checked"));
                });
            },
            selectRecord: function () {
                if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
                    this.is_show = true;
                } else {
                    this.is_show = false;
                }
            },
            deleteChecked: function (msg, text) {
                var deleteIDs = jQuery("#checked-val input:checkbox:checked").map(function () {
                    return jQuery(this).val();
                }).get();
                var self = this;
                this.$swal({
                    title: msg,
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        axios.post(APP_URL + '/admin/delete-checked-langs', {
                            ids: deleteIDs
                        })
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    setTimeout(function () {
                                        self.$swal({
                                            title: this.title,
                                            text: text,
                                            type: "success"
                                        })
                                    }, 500);
                                    window.location.replace(APP_URL + '/admin/languages');
                                } else {
                                    self.showError(response.data.message);
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            }
        }
    });
}

if (document.getElementById("user_profile")) {
    const freelancerProfile = new Vue({
        el: '#user_profile',
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        created: function () {
            Event.$on('award-component-render', (data) => {
                this.server_error = data.error;
            })
            Event.$on('experience-component-render', (data) => {
                this.experience_server_error = data.error;
            })
        },
        data: {
            loading: false,
            server_error: '',
            experience_server_error: '',
            disable_btn: '',
            saved_class: 'far fa-heart',
            job_saved_class: 'far fa-heart',
            click_to_save: '',
            text: Vue.prototype.trans('lang.click_to_save'),
            follow_text: Vue.prototype.trans('lang.click_to_follow'),
            disable_job_save: '',
            disable_follow: '',
            job_click_to_save: '',
            avater_id: 'profile_image',
            banner_id: 'profile_banner',
            avater_ref: 'profile_image_ref',
            banner_ref: 'profile_banner_ref',
            uploaded_image: false,
            uploaded_banner: false,
            report: {
                reason: '',
                description: '',
                id: '',
                model: 'App\\User',
                report_type: '',
            },
            notificationSystem: {
                options: {
                    success: {
                        position: "topRight",
                        timeout: 3000,
                        class: 'success_notification'
                    },
                    error: {
                        position: "topRight",
                        timeout: 4000,
                        class: 'error_notification'
                    },
                    completed: {
                        position: 'center',
                        timeout: 1000,
                        class: 'complete_notification'
                    },
                    info: {
                        overlay: true,
                        zindex: 999,
                        position: 'center',
                        timeout: 3000,
                        class: 'info_notification',
                        onClosing: function (instance, toast, closedBy) {
                            freelancerProfile.showCompleted(Vue.prototype.trans('lang.profile_update_success'));
                        }
                    }
                }
            },
            is_popup: false,
        },
        ready: function () {

        },
        methods: {
            showCompleted(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.completed);
            },
            showInfo(message) {
                return this.$toast.info(' ', message, this.notificationSystem.options.info);
            },
            showMessage(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.success);
            },
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            submitProfileSettings: function () {
                this.loading = true;
                var self = this;
                var profile_form = document.getElementById('profile_form');
                let form_data = new FormData(profile_form);
                axios.post(APP_URL + '/freelancer/profile-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.next();
                        } else if (response.data.type == 'error') {
                            self.custom_error = true;
                            if (response.data.email_error) self.form_errors.push(response.data.email_error);
                            if (response.data.password_error) self.form_errors.push(response.data.password_error);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            removeImage: function (event) {
                this.uploaded_image = true;
                document.getElementById("hidden_avater").value = '';
            },
            removeBanner: function (event) {
                this.uploaded_banner = true;
                document.getElementById("hidden_banner").value = '';
            },
            submitFreelancerProfile: function () {
                var self = this;
                var profile_data = document.getElementById('freelancer_profile');
                let form_data = new FormData(profile_data);
                axios.post(APP_URL + '/freelancer/store-profile-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(Vue.prototype.trans('lang.saving_profile'));
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.first_name) {
                            self.showError(error.response.data.errors.first_name[0]);
                        }
                        if (error.response.data.errors.last_name) {
                            self.showError(error.response.data.errors.last_name[0]);
                        }
                        if (error.response.data.errors.email) {
                            self.showError(error.response.data.errors.email[0]);
                        }
                        if (error.response.data.errors.gender) {
                            self.showError(error.response.data.errors.gender[0]);
                        }
                    });
            },
            submitExperienceEduction: function () {
                var self = this;
                var exp_edu_data = document.getElementById('experience_form');
                let form_data = new FormData(exp_edu_data);
                axios.post(APP_URL + '/freelancer/store-experience-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(response.data.message);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status == 422) {
                            self.showError(self.experience_server_error);
                        }
                    });
            },
            submitPaymentSettings: function () {
                var self = this;
                var payment = document.getElementById('payment_settings');
                let form_data = new FormData(payment);
                axios.post(APP_URL + '/freelancer/store-payment-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(response.data.processing);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/freelancer/dashboard');
                            }, 4000);
                        } else {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.payout_id) {
                            self.showError(error.response.data.errors.payout_id[0]);
                        }
                    });
            },
            submitAwardsProjects: function () {
                var self = this;
                var awards_projects = document.getElementById('awards_projects');
                let form_data = new FormData(awards_projects);
                axios.post(APP_URL + '/freelancer/store-project-award-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(response.data.message);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status == 422) {
                            self.showError(self.server_error);
                        }
                    });
            },
            submitEmployerProfile: function () {
                var self = this;
                var profile_data = document.getElementById('employer_data');
                let form_data = new FormData(profile_data);
                axios.post(APP_URL + '/employer/store-profile-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(response.data.process);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/employer/dashboard');
                            }, 4000);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.first_name) {
                            self.showError(error.response.data.errors.first_name[0]);
                        }
                        if (error.response.data.errors.last_name) {
                            self.showError(error.response.data.errors.last_name[0]);
                        }
                        if (error.response.data.errors.email) {
                            self.showError(error.response.data.errors.email[0]);
                        }
                    });
            },
            submitAdminProfile: function () {
                var self = this;
                var profile_data = document.getElementById('admin_data');
                let form_data = new FormData(profile_data);
                axios.post(APP_URL + '/admin/store-profile-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(response.data.process);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/admin/profile');
                            }, 4000);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.first_name) {
                            self.showError(error.response.data.errors.first_name[0]);
                        }
                        if (error.response.data.errors.last_name) {
                            self.showError(error.response.data.errors.last_name[0]);
                        }
                        if (error.response.data.errors.email) {
                            self.showError(error.response.data.errors.email[0]);
                        }
                    });
            },
            submitUserProfile: function () {
                var self = this;
                var profile_data = document.getElementById('user_data');
                let form_data = new FormData(profile_data);
                axios.post(APP_URL + '/user/store-profile-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showInfo(response.data.process);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/user/profile');
                            }, 4000);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.first_name) {
                            self.showError(error.response.data.errors.first_name[0]);
                        }
                        if (error.response.data.errors.last_name) {
                            self.showError(error.response.data.errors.last_name[0]);
                        }
                        if (error.response.data.errors.email) {
                            self.showError(error.response.data.errors.email[0]);
                        }
                    });
            },
            sendOffer: function (auth_user) {
                if (auth_user == 1) {
                    this.$refs.myModalRef.show();
                } else {
                    jQuery('.wt-loginarea .wt-loginformhold').slideToggle();
                }
            },
            submitProjectOffer: function (id) {
                this.loading = true;
                let offer_form = document.getElementById('send-offer-form');
                let form_data = new FormData(offer_form);
                form_data.append('freelancer_id', id);
                var self = this;
                axios.post(APP_URL + '/store/project-offer', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.loading = false;
                            self.$refs.myModalRef.hide();
                            self.showInfo(response.data.progressing);
                            self.success_message = response.data.message;
                        } else if (response.data.type == 'error') {
                            self.loading = false;
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        self.loading = false;
                        if (error.response.data.errors.projects) {
                            self.showError(error.response.data.errors.projects[0]);
                        }
                        if (error.response.data.errors.desc) {
                            self.showError(error.response.data.errors.desc[0]);
                        }
                    });
            },
            openChatBox: function () {
                if (this.is_popup == false) {
                    this.is_popup = true;
                } else {
                    this.is_popup = false;
                }
            },
            submitReport: function (id, report_type) {
                this.report.report_type = report_type;
                this.report.id = id;
                var self = this;
                axios.post(APP_URL + '/submit-report', self.report)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.showMessage(response.data.message);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }

                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            if (error.response.data.errors.description) {
                                self.showError(error.response.data.errors.description[0]);
                            }
                            if (error.response.data.errors.reason) {
                                self.showError(error.response.data.errors.reason[0]);
                            }
                        }
                    });
            },
            add_wishlist: function (element_id, id, column, saved_text) {
                var self = this;
                axios.post(APP_URL + '/user/add-wishlist', {
                    id: id,
                    column: column,
                })
                    .then(function (response) {
                        if (response.data.authentication == true) {
                            if (response.data.type == 'success') {
                                if (column == 'saved_freelancer') {
                                    jQuery('#' + element_id).parents('li').addClass('wt-btndisbaled');
                                    jQuery('#' + element_id).addClass('wt-clicksave');
                                    jQuery('#' + element_id).find('.save_text').text(saved_text);
                                    self.disable_btn = 'wt-btndisbaled';
                                    self.text = Vue.prototype.trans('lang.btn_save');
                                    self.saved_class = 'fa fa-heart';
                                    self.click_to_save = 'wt-clicksave'
                                }
                                else if (column == 'saved_employers') {
                                    jQuery('#' + element_id).addClass('wt-btndisbaled wt-clicksave');
                                    jQuery('#' + element_id).text(saved_text);
                                    jQuery('#' + element_id).parents('.wt-clicksavearea').find('i').addClass('fa fa-heart');
                                    self.disable_follow = 'wt-btndisbaled';
                                    self.follow_text = saved_text;
                                }
                                else if (column == 'saved_jobs') {
                                    jQuery('#' + element_id).parents('li').addClass('wt-btndisbaled');
                                    jQuery('#' + element_id).addClass('wt-clicksave');
                                    jQuery('#' + element_id).find('.save_text').text(saved_text);
                                }
                                self.showMessage(response.data.message);
                            } else {
                                self.showError(response.data.message);
                            }
                        } else {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getWishlist: function () {
                var self = this;
                var segment_str = window.location.pathname;
                var segment_array = segment_str.split('/');
                var slug = segment_array[segment_array.length - 1];
                axios.post(APP_URL + '/profile/get-wishlist', {
                    slug: slug
                })
                    .then(function (response) {
                        if (response.data.user_type == 'freelancer') {
                            if (response.data.current_freelancer == 'true') {
                                self.disable_btn = 'wt-btndisbaled';
                                self.text = Vue.prototype.trans('lang.saved');
                                self.saved_class = 'fa fa-heart';
                            }
                        } else if (response.data.user_type == 'employer') {
                            if (response.data.employer_jobs == 'true') {
                                self.disable_btn = 'wt-btndisbaled';
                                self.text = Vue.prototype.trans('lang.saved');
                                self.saved_class = 'fa fa-heart';
                            }
                            if (response.data.current_employer == 'true') {
                                self.disable_follow = 'wt-btndisbaled';
                                self.follow_text = Vue.prototype.trans('lang.following');
                            }
                        }
                    });
            },
        }
    });
}

//Settings
if (document.getElementById("settings")) {
    const VueSettings = new Vue({
        el: "#settings",
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
            //Delete Social
            var count_social_length = jQuery('.social-icons-content').find('.wrap-social-icons').length;
            count_social_length = count_social_length - 1;
            this.social.count = count_social_length;
            jQuery(document).on('click', '.delete-social', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.parents('.wrap-social-icons').remove();
            });
            //Delete Search
            var count_social_length = jQuery('.search-content').find('.wrap-search').length;
            count_social_length = count_social_length - 1;
            this.social.count = count_social_length;
            jQuery(document).on('click', '.delete-search', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.parents('.wrap-search').remove();
            });
        },
        components: { Verte },
        data: {
            enable_sandbox:false,
            show_reg_form_banner:false,
            enable_breadcrumbs: false,
            show_emplyr_inn_sec: false,
            show_f_banner: false,
            employer_package: true,
            enable_packages: false,
            show_emp_banner: false,
            show_job_banner: false,
            show_service_banner: false,
            primary_color: '#ff5851',
            enable_theme_color: false,
            enable_color_text: '',
            cat_section_display: false,
            home_section_display: false,
            show_services_section: true,
            chat_display: false,
            app_section_display: false,
            uploaded_logo: false,
            uploaded_banner: false,
            uploaded_avatar: false,
            uploaded_banner_bg: false,
            uploaded_banner_image: false,
            uploaded_section_bg: false,
            uploaded_download_app_img: false,
            footer_logo: false,
            logo: false,
            register_image: false,
            f_inner_banner: false,
            e_inner_banner: false,
            job_inner_banner: false,
            service_inner_banner: false,
            clear_cache: false,
            clear_views: false,
            clear_routes: false,
            favicon: false,
            reg_form_banner: false,
            success_message: '',
            notificationSystem: {
                options: {
                    success: {
                        position: "topRight",
                        timeout: 4000
                    },
                    error: {
                        position: "topRight",
                        timeout: 7000
                    },
                    completed: {
                        position: 'center',
                        timeout: 1000,
                        progressBar: false
                    },
                    info: {
                        overlay: true,
                        zindex: 999,
                        position: 'center',
                        timeout: 3000,
                        onClosing: function (instance, toast, closedBy) {
                            VueSettings.showCompleted(VueSettings.success_message);
                        }
                    }
                }
            },
            social: {
                social_name: Vue.prototype.trans('lang.select_socials'),
                social_url: '',
                count: 0,
                success_message: '',
                loading: false
            },
            search: {
                search_name: Vue.prototype.trans('lang.add_title'),
                search_url: '',
                count: 0,
                success_message: '',
                loading: false
            },
            socials: [],
            first_social_name: '',
            first_social_url: '',
            searches: [],
            first_search_title: '',
            first_search_url: '',
            loading: false,
        },
        created: function () {
            this.getHomeSectionDisplaySetting();
            this.getChatDisplaySetting();
            this.getPrimaryColorDisplaySetting();
            this.getInnerPageSettings();
            this.getRegistrationSettings();
            this.getSitePaymentOptions();
            this.getBreadcrumbsSettings();
        },
        ready: function () { },
        methods: {
            getHomeSectionDisplaySetting: function () {
                let self = this;
                axios.get(APP_URL + '/admin/get-section-display-setting')
                    .then(function (response) {
                        if ((response.data.home_section_display == 'true')) {
                            self.home_section_display = true;
                        } else {
                            self.home_section_display = false;
                        }
                        if ((response.data.app_section_display == 'true')) {
                            self.app_section_display = true;
                        } else {
                            self.app_section_display = false;
                        }
                        if ((response.data.show_services_section == 'true')) {
                            self.show_services_section = true;
                        } else {
                            self.show_services_section = false;
                        }
                    });
            },
            getPrimaryColorDisplaySetting: function () {
                let self = this;
                axios.get(APP_URL + '/admin/get-theme-color-display-setting')
                    .then(function (response) {
                        if ((response.data.enable_theme_color == 'true')) {
                            self.enable_theme_color = true;
                            self.enable_color_text = Vue.prototype.trans('lang.primary_color');
                            if (response.data.color) {
                                self.primary_color = response.data.color;
                            }
                        } else {
                            self.enable_theme_color = false;
                        }
                    });
            },
            getChatDisplaySetting: function () {
                let self = this;
                axios.get(APP_URL + '/admin/get-chat-display-setting')
                    .then(function (response) {
                        if ((response.data.chat_display == 'true')) {
                            self.chat_display = true;
                        } else {
                            self.chat_display = false;
                        }
                    });
            },
            addSocial: function () {
                this.socials.push(Vue.util.extend({}, this.social, this.social.count++))
            },
            removeSocial: function (index) {
                Vue.delete(this.socials, index);
            },
            addSearchItem: function () {
                this.searches.push(Vue.util.extend({}, this.search, this.search.count++))
            },
            removeSearchItem: function (index) {
                Vue.delete(this.searches, index);
            },
            showCompleted(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.completed);
            },
            showInfo(message) {
                return this.$toast.info(' ', message, this.notificationSystem.options.info);
            },
            showMessage(message) {
                return this.$toast.success(Vue.prototype.trans('lang.success'), message, this.notificationSystem.options.success);
            },
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            submitGeneralSettings: function () {
                let settings_form = document.getElementById('general-setting-form');
                let form_data = new FormData(settings_form);
                var self = this;
                axios.post(APP_URL + '/admin/store/settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/admin/settings');
                            }, 4000)
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitChatSettings: function () {
                let chatForm = document.getElementById('submit-chat-form');
                let form_data = new FormData(chatForm);
                var self = this;
                axios.post(APP_URL + '/admin/store/chat-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            uploadDashboardIcons: function () {
                let upload_icon_form = document.getElementById('upload_dashboard_icon');
                let form_data = new FormData(upload_icon_form);
                var self = this;
                axios.post(APP_URL + '/admin/store/upload-icons', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/admin/settings');
                            }, 4000)
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitThemeStylingSettings: function () {
                let settings_form = document.getElementById('styling-setting-form');
                let form_data = new FormData(settings_form);
                var self = this;
                axios.post(APP_URL + '/admin/store/theme-styling-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                            setTimeout(function () {
                                window.location.replace(APP_URL + '/admin/settings');
                            }, 4000)
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitFooterSettings: function () {
                let footersettings = document.getElementById('footer-setting-form');
                let data = new FormData(footersettings);
                var self = this;
                axios.post(APP_URL + '/admin/store/footer-settings', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitAccessType: function () {
                let footersettings = document.getElementById('acces_types_form');
                let data = new FormData(footersettings);
                var self = this;
                axios.post(APP_URL + '/admin/store/access-type-settings', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitSocialSettings: function () {
                let socialsettings = document.getElementById('social-management');
                let data = new FormData(socialsettings);
                var self = this;
                axios.post(APP_URL + '/admin/store/social-settings', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitSearchMenu: function () {
                let searchMenu = document.getElementById('search-menu');
                let data = new FormData(searchMenu);
                var self = this;
                axios.post(APP_URL + '/admin/store/search-menu', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.menu_title) {
                            self.showError(error.response.data.errors.menu_title[0]);
                        }
                    });
            },
            submitCommisionSettings: function () {
                let commision_settings = document.getElementById('comission-form');
                let data = new FormData(commision_settings);
                var self = this;
                axios.post(APP_URL + '/admin/store/commision-settings', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }

                    })
                    .catch(function (error) { });
            },
            submitPaypalSettings: function () {
                let payment_settings = document.getElementById('payment-form');
                let data = new FormData(payment_settings);
                var self = this;
                axios.post(APP_URL + '/admin/store/payment-settings', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.client_id) {
                            self.showError(error.response.data.errors.client_id[0]);
                        }
                        if (error.response.data.errors.paypal_password) {
                            self.showError(error.response.data.errors.paypal_password[0]);
                        }
                        if (error.response.data.errors.paypal_secret) {
                            self.showError(error.response.data.errors.paypal_secret[0]);
                        }
                    });
            },
            submitStripeSettings: function () {
                let payment_settings = document.getElementById('stripe-form');
                let data = new FormData(payment_settings);
                var self = this;
                axios.post(APP_URL + '/admin/store/stripe-payment-settings', data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.stripe_key) {
                            self.showError(error.response.data.errors.stripe_key[0]);
                        }
                        if (error.response.data.errors.stripe_secret) {
                            self.showError(error.response.data.errors.stripe_secret[0]);
                        }
                    });
            },
            emailContent: function (reference) {
                this.$refs[reference].show();
            },
            submitEmailSettings: function () {
                let settings_form = document.getElementById('email-setting-form');
                let form_data = new FormData(settings_form);
                var self = this;
                axios.post(APP_URL + '/admin/store/email-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitHomeSettings: function () {
                let settings_form = document.getElementById('home-settings-form');
                let form_data = new FormData(settings_form);
                var description = tinyMCE.get('wt-tinymceeditor').getContent();
                form_data.append('app_desc', description);
                var self = this;
                axios.post(APP_URL + '/admin/store/home-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitSectionSettings: function () {
                let settings_form = document.getElementById('section-settings-form');
                let form_data = new FormData(settings_form);
                var description = tinyMCE.get('app_desc_wt_tinymceeditor').getContent();
                console.log(description);
                // return false;
                form_data.append('app_desc', description);
                var self = this;
                axios.post(APP_URL + '/admin/store/section-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            submitServicesSectionSettings: function () {
                let settings_form = document.getElementById('services-sec-settings');
                let form_data = new FormData(settings_form);
                var description = tinyMCE.get('wt-tinymceeditor').getContent();
                form_data.append('description', description);
                var self = this;
                axios.post(APP_URL + '/admin/store/service-section-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            removeImage: function (id) {
                if (id == 'hidden_site_logo') {
                    this.logo = true;
                }
                if (id == 'hidden_logo') {
                    this.uploaded_logo = true;
                }
                if (id == 'hidden_banner') {
                    this.uploaded_banner = true;
                }
                if (id == 'hidden_avatar') {
                    this.uploaded_avatar = true;
                }
                if (id == 'hidden_home_banner') {
                    this.uploaded_banner_bg = true;
                }
                if (id == 'hidden_banner_image') {
                    this.uploaded_banner_image = true;
                }
                if (id == 'hidden_section_bg') {
                    this.uploaded_section_bg = true;
                }
                if (id == 'hidden_download_app_img') {
                    this.uploaded_download_app_img = true;
                }
                if (id == 'hidden_site_footer_logo') {
                    this.footer_logo = true;
                }
                if (id == 'hidden_site_register_image') {
                    this.register_image = true;
                }
                if (id == 'hidden_f_inner_banner') {
                    this.f_inner_banner = true;
                }
                if (id == 'hidden_e_inner_banner') {
                    this.e_inner_banner = true;
                }
                if (id == 'hidden_job_inner_banner') {
                    this.job_inner_banner = true;
                }
                if (id == 'hidden_service_inner_banner') {
                    this.service_inner_banner = true;
                }
                if (id == 'hidden_site_favicon') {
                    this.favicon = true;
                }
                if (id == 'hidden_reg_form_banner') {
                    this.reg_form_banner = true;
                }
                document.getElementById(id).value = '';
            },
            importDemo: function (text) {
                var self = this;
                this.$swal({
                    title: text,
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        self.loading = true;
                        window.location.replace(APP_URL + '/admin/import-demo');
                    } else {
                        this.$swal.close()
                    }
                })
            },
            removeDemoContent: function (text) {
                var self = this;
                this.$swal({
                    title: text,
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        self.loading = true;
                        window.location.replace(APP_URL + '/admin/remove-demo');
                    } else {
                        this.$swal.close()
                    }
                })
            },
            clearCache: function () {
                var self = this;
                var clear_cache_form = document.getElementById('form-cache-clear');
                let form_data = new FormData(clear_cache_form);
                this.$swal({
                    title: Vue.prototype.trans('lang.clear_selected_cache'),
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        self.loading = true;
                        axios.post(APP_URL + '/admin/clear-cache', form_data)
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    self.loading = false;
                                    self.$swal(Vue.prototype.trans(lang.deleted), Vue.prototype.trans(lang.cache_cleared), Vue.prototype.trans(lang.success))
                                } else {
                                    self.loading = false;
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            },
            clearAllCache: function () {
                var self = this;
                this.$swal({
                    title: Vue.prototype.trans('lang.clr_all_cache'),
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    self.loading = true;
                    if (result.value) {
                        axios.get(APP_URL + '/admin/clear-allcache')
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    self.loading = false;
                                    self.$swal(Vue.prototype.trans(lang.cleared), Vue.prototype.trans(lang.cache_cleared), Vue.prototype.trans(lang.success))
                                } else {
                                    self.loading = false;
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            },
            importUpdate: function (success_title, success_text) {
                this.$swal({
                    title: Vue.prototype.trans('lang.imprt_tables'),
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        self.loading = true;
                        axios.get(APP_URL + '/admin/import-updates')
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    self.loading = false;
                                    self.$swal(success_title, success_text, 'success')
                                    window.location.replace(APP_URL + '/admin/settings');
                                } else {
                                    self.loading = false;
                                }
                            })
                    } else {
                        self.$swal.close()
                    }
                }) 
            },
            submitTemplateFilter: function () {
                document.getElementById("template_filter_form").submit();
            },
            submitInnerPage: function () {
                let settings_form = document.getElementById('inner-page-form');
                let form_data = new FormData(settings_form);
                var self = this;
                axios.post(APP_URL + '/admin/store/innerpage-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            getInnerPageSettings: function () {
                let self = this;
                axios.post(APP_URL + '/admin/get/innerpage-settings')
                    .then(function (response) {
                        if ((response.data.show_f_banner == 'true')) {
                            self.show_f_banner = true;
                        } else {
                            self.show_f_banner = false;
                        }
                        if ((response.data.show_emp_banner == 'true')) {
                            self.show_emp_banner = true;
                        } else {
                            self.show_emp_banner = false;
                        }
                        if ((response.data.show_job_banner == 'true')) {
                            self.show_job_banner = true;
                        } else {
                            self.show_job_banner = false;
                        }
                        if ((response.data.show_service_banner == 'true')) {
                            self.show_service_banner = true;
                        } else {
                            self.show_service_banner = false;
                        }
                    });
            },
            getRegistrationSettings: function () {
                let self = this;
                axios.get(APP_URL + '/admin/get/registration-settings')
                    .then(function (response) {
                        if (response.data.show_emplyr_inn_sec == 'true') {
                            self.show_emplyr_inn_sec = true;
                        } else {
                            self.show_emplyr_inn_sec = false;
                        }
                        if (response.data.show_reg_form_banner == 'true') {
                            self.show_reg_form_banner = true;
                        } else {
                            self.show_reg_form_banner = false;
                        }
                    });
            },
            getSitePaymentOptions: function () {
                let self = this;
                axios.get(APP_URL + '/admin/get/site-payment-option')
                    .then(function (response) {
                        if (response.data.enable_packages == 'true') {
                            self.enable_packages = true;
                        } else {
                            self.enable_packages = false;
                        }
                        if (response.data.employer_package == 'true') {
                            self.employer_package = true;
                        } else {
                            self.employer_package = false;
                        }
                        if (response.data.enable_sandbox == 'true') {
                            self.enable_sandbox = true;
                        } else {
                            self.enable_sandbox = false;
                        }
                    });
            },
            submitBreadcrumbs: function () {
                let settings_form = document.getElementById('breadcrumb-option');
                let form_data = new FormData(settings_form);
                var self = this;
                axios.post(APP_URL + '/admin/store/breadcrumbs-settings', form_data)
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            self.success_message = response.data.message;
                            self.showInfo(response.data.progressing);
                        } else if (response.data.type == 'error') {
                            self.showError(response.data.message);
                        }
                    })
                    .catch(function (error) { });
            },
            getBreadcrumbsSettings: function () {
                let self = this;
                axios.post(APP_URL + '/admin/get/breadcrumbs-settings')
                    .then(function (response) {
                        if ((response.data.breadcrumbs_settings == 'true')) {
                            self.enable_breadcrumbs = true;
                        } else {
                            self.enable_breadcrumbs = false;
                        }
                    });
            },
        }
    });
}
//Profile Settings
if (document.getElementById("profile_settings")) {
    const switchButton = new Vue({
        el: "#profile_settings",
        mounted: function () {
            if (document.getElementsByClassName("flash_msg") != null) {
                flashVue.$emit('showFlashMessage');
            }
        },
        data: function () {
            return {
                profile_blocked: true,
                profile_searchable: true,
                weekly_alerts: true,
                message_alerts: false,
                success_message: '',
                notificationSystem: {
                    options: {
                        success: {
                            position: "topRight",
                            timeout: 4000
                        },
                        error: {
                            position: "topRight",
                            timeout: 7000
                        },
                        completed: {
                            position: 'center',
                            timeout: 1000,
                            progressBar: false
                        },
                        info: {
                            overlay: true,
                            zindex: 999,
                            position: 'center',
                            timeout: 3000,
                            onClosing: function (instance, toast, closedBy) {
                                VueSettings.showCompleted(VueSettings.success_message);
                            }
                        }
                    }
                }

            };
        },
        created: function () {
            this.getUserEmailNotification();
            this.getSearchableSettings();
        },
        ready: function () {
            this.deleteAccount();
        },
        methods: {
            showCompleted(message) {
                return this.$toast.success(' ', message, this.notificationSystem.options.completed);
            },
            showInfo(message) {
                return this.$toast.info(' ', message, this.notificationSystem.options.info);
            },
            showMessage(message) {
                return this.$toast.success('Success', message, this.notificationSystem.options.success);
            },
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error);
            },
            deleteAccount: function (event) {
                var self = this;
                var delete_acc_form = document.getElementById('delete_acc_form');
                let form_data = new FormData(delete_acc_form);
                this.$swal({
                    title: Vue.prototype.trans('lang.delete_account'),
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        axios.post(APP_URL + '/profile/settings/delete-user', form_data)
                            .then(function (response) {
                                if (response.data.type === 'warning') {
                                    self.showError(response.data.msg);
                                } else {
                                    setTimeout(function () {
                                        swal({
                                            type: "success"
                                        })
                                    },
                                        self.showInfo(response.data.acc_del), 1000);
                                    window.location.href = APP_URL + '/';
                                }
                            })
                            .catch(function (error) {
                                if (error.response.data.errors.old_password) {
                                    self.showError(error.response.data.errors.old_password[0]);
                                }
                                if (error.response.data.errors.retype_password) {
                                    self.showError(error.response.data.errors.retype_password[0]);
                                }
                            });
                    } else {
                        this.$swal.close()
                    }
                })
            },
            deleteUser: function (id) {
                var self = this;
                this.$swal({
                    title: Vue.prototype.trans('lang.delete_user'),
                    type: "warning",
                    customContainerClass: 'hire_popup',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    var self = this;
                    if (result.value) {
                        axios.post(APP_URL + '/admin/delete-user', {
                            user_id: id
                        })
                            .then(function (response) {
                                if (response.data.type == "success") {
                                    setTimeout(function () {
                                        self.$swal({
                                            title: this.title,
                                            text: Vue.prototype.trans('lang.ph_user_delete_message'),
                                            type: "success"
                                        })
                                    }, 100);
                                    setTimeout(function () {
                                        jQuery('.del-user-' + id).remove();
                                        window.location.replace(APP_URL + '/users');
                                    }, 500);
                                } else {
                                    self.showError(response.data.message);
                                }
                            })
                    } else {
                        this.$swal.close()
                    }
                })
            },
            getUserEmailNotification: function () {
                let self = this;
                axios.get(APP_URL + '/profile/settings/get-user-notification-settings')
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            if ((response.data.weekly_alerts == 'true')) {
                                self.weekly_alerts = true;
                            } else {
                                self.weekly_alerts = false;
                            }
                            if ((response.data.message_alerts == 'true')) {
                                self.message_alerts = true;
                            } else {
                                self.message_alerts = false;
                            }
                        }
                    });
            },
            getSearchableSettings: function () {
                let self = this;
                axios.get(APP_URL + '/profile/settings/get-user-searchable-settings')
                    .then(function (response) {
                        if (response.data.type == 'success') {
                            if ((response.data.profile_blocked == 'true')) {
                                self.profile_blocked = true;
                            } else {
                                self.profile_blocked = false;
                            }
                        }
                    });
            },
        }

    });
}

