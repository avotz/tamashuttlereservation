
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('reservations-form', require('./components/ReservationsForm.vue'));
Vue.component('reservations-list', require('./components/ReservationsList.vue'));
Vue.component('agenda', require('./components/Agenda.vue'));
Vue.component('alert', require('./components/Alert.vue'));

window.bus = new Vue();

const app = new Vue({
    el: '#app',
    data: {
       message: {
         show:false,
         text: "",
         type: "info"
       }
    },
    created() {
      bus.$on('alert', this.alertMessage);
      
    },
    methods:{
       alertMessage (message, type = "info") {
          console.log('aler from main app');
          this.message.text = message;
          this.message.show = true;
          this.message.type = type;
          setTimeout(
            () => {
              this.message.show = false,
              this.message.text = ""
            },
            3000
          )
        }
    
    }
});

$(window).on('load', function() {

      $('.preloader').addClass('animated fadeOut').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $('.preloader').hide();
        
      });


  });


    var isMobile = {
      Android: function() {
          return navigator.userAgent.match(/Android/i);
      },
      BlackBerry: function() {
          return navigator.userAgent.match(/BlackBerry/i);
      },
      iOS: function() {
          return navigator.userAgent.match(/iPhone|iPad|iPod/i);
      },
      Opera: function() {
          return navigator.userAgent.match(/Opera Mini/i);
      },
      Windows: function() {
          return navigator.userAgent.match(/IEMobile/i);
      },
      any: function() {
          return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
      }
  };

  /* if( isMobile.any() ) {
      $('.box-create-appointment').hide();
    }else{
      //$('.box-create-appointment').show();
    }*/

    //$(".dropdown-toggle").dropdown();

    

    $("form[data-confirm]").submit(function() {
        if ( ! confirm($(this).attr("data-confirm"))) {
            return false;
        }
    });
    
     function submitForm(){
        $('.filters').find('form').submit();
    }

   // $('select.select2').select2();

    $('select[name=role]').change(submitForm);
    $('select[name=vehicle]').change(submitForm);

    $('.nav-toggle').on('click',function (e) {
       $('.nav-right.nav-menu').toggleClass('is-active');
    });
   
    

   
    
    
   


