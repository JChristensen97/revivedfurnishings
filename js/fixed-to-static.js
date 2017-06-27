var windw = this;

// $.fn.followTo = function ( pos ) {
//     var $this = this,
//         $window = $(windw);
    
//     $window.scroll(function(e){
//         if ($window.scrollTop() > pos) {
//             $this.css({
//                 position: 'absolute',
//                 top: pos + 143
//             });
//         } else {
//             $this.css({
//                 position: 'fixed',
//                 top: 143
//             });
//         }
//     });
// };

// $('.right-side').followTo(800);

const $rs = $('.right-side');
const $ls = $('.left-side');

let rsHeight = $('.right-side').height();
let lsHeight = $('.left-side').height();

let counter = 0;

console.log(rsHeight);

$ls.waypoint(function(direction){

    counter++

    if(counter > 0){
      console.log('bottom in view...');
      $rs.toggleClass('right-side-to-static'); 
    }


    
},{
 //bottom-in-view will ensure event is thrown when the element's bottom crosses
 //bottom of viewport.
 offset: 'bottom-in-view'
});

