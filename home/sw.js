var CACHE_NAME = 'bpsdmp-cache-v1'+ new Date().getTime();
// var base_url = window.location.origin
var urlsToCache = [
  '//kabayanconsulting.co.id/bpsdmp/public/home/',
  '//kabayanconsulting.co.id/bpsdmp/public/home/index.php',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/bpsdm2.PNG',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/13.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/images/preloader@2x.gif',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/faq.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/images/icons/submenu.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/images/world-map.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/bpsdm.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/icon/clip.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/icon/bigdata.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/icon/file.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/icon/penerimaan.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/ship.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/army.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/suv.png',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/slide7.JPG',
  '//kabayanconsulting.co.id/bpsdmp/public/home/images/pattern2.png',
  
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/offline/offline1.jpg',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/offline/offline2.jpg',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/offline/offline3.jpg',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/offline/offline4.jpg',
  '//kabayanconsulting.co.id/bpsdmp/public/home/gambar/offline/offline5.jpg',

  '//kabayanconsulting.co.id/bpsdmp/public/home/manifest.json',

  '//kabayanconsulting.co.id/bpsdmp/public/home/css/fontawesome/font-awesome.css',
  
  '//kabayanconsulting.co.id/bpsdmp/public/home/js/jquery.js',
  '//kabayanconsulting.co.id/bpsdmp/public/home/js/main.js',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/bootstrap.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/style.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/swiper.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/dark.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/font-icons.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/animate.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/magnific-popup.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/customresponsive.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/responsive.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/mycss.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/js/plugins.js',
  '//kabayanconsulting.co.id/bpsdmp/public/home/js/functions.js',
  '//kabayanconsulting.co.id/bpsdmp/public/home/tavocal/tavo-calendar.js',
  '//kabayanconsulting.co.id/bpsdmp/public/home/tavocal/tavo-calendar.css',
  '//kabayanconsulting.co.id/bpsdmp/public/home/css/fonts/font-icons.ttf',
  '//kabayanconsulting.co.id/bpsdmp/public/home/fallback.json',
  '//unpkg.com/sweetalert/dist/sweetalert.min.js', 
];



self.addEventListener('install', function(event) {
  // Perform install steps
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('in install service worker ...  Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
    var request = event.request
    var url = new URL(request.url)

    if(url.origin != location.origin){
      event.respondWith(
        caches.open('dynamic-cache').then(function(cache){
            return fetch(request).then(function(liveResponse){
                try {
                  cache.put(request, liveResponse.clone())
                  return liveResponse
                } catch (error) {
                
                }
               
            }).catch(function(e){
                console.log(e)
            })
        })
    );
          
  }else{
    event.respondWith(
      caches.match(request.url)
        .then(function(response) {
          // console.log()
          if (response) {
            return response;
          }
          return fetch(event.request);
        }
      )
    );
      // console.log(request)
    
  }   
  });

  self.addEventListener('activate', function(event) {

    
  
    event.waitUntil(
      caches.keys().then(function(cacheNames) {
        return Promise.all(
          cacheNames.filter(function(cacheName){
              return cacheName != CACHE_NAME
          }).map(function(cacheName){
              return caches.delete(cacheName)
          })
        );
      })
    );
  });

