<!-- template js files -->
@livewireScripts

<script>
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.remove();
        }
    });
</script>
<script src="{{ asset('site/js/jquery-3.4.1.min.js') }}"></script>

<script src="{{asset("assets/js/dependencies/alpinejs.min.js")}}"></script>
<script src="{{asset("assets/js/dependencies/swiper-bundle.min.js")}}"></script>
<script src="{{asset("assets/js/dependencies/plyr.min.js")}}"></script>
<script src="{{asset("assets/js/app.js")}}"></script>

<script>
    $(document).ready(function (){
        Livewire.on('notify', data => {
            Swal.fire({
                position: 'top-end',
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 3500,
                toast: true,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        })

        Livewire.on('showModal', data => {
            Swal.fire({
                position: 'center',
                icon: data.icon,
                title: data.title,
                text: data.text,
                confirmButtonText:'باشه',
                showConfirmButton: true,
                toast: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        })
    })
</script>
<script type="text/javascript">
  !function(){var i="jY2uim",a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
</script>