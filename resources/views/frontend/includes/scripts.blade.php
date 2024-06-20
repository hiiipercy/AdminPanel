 <!-- Bootstrap core JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>


 <!-- Additional Scripts -->
 <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/slick.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/accordions.js') }}"></script>

 <script language="text/Javascript">
     cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
     function clearField(t) { //declaring the array outside of the
         if (!cleared[t.id]) { // function makes it static and global
             cleared[t.id] = 1; // you could use true and false, but that's more typing
             t.value = ''; // with more chance of typos
             t.style.color = '#fff';
         }
     }
 </script>