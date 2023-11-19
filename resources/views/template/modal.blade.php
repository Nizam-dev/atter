   <!-- Modal -->
   <div class="modal fade" id="modalquote" tabindex="-1" role="dialog" aria-labelledby="modalquoteLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form action="" method="post" id="formquote">
                       @csrf
                       <div class="form-group">
                           <input type="text" class="form-control" name='rtwt' placeholder="Quote" required>
                       </div>
                       <button type="submit" class="d-none"></button>
                   </form>
                   <div class="postquote"></div>
               </div>
               <div class="modal-footer">
                   <button type="button" onclick="quotesubmit()" class="btn btn-primary">Quote</button>
               </div>
           </div>
       </div>
   </div>



   <!--Comment-->
   <div class="modal fade" id="modalkomen" tabindex="-1" role="dialog" aria-labelledby="modalkomenLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="postkomentar"></div>

               </div>
               <div class="modal-footer d-block">

                   <form action="" method="post" id="formkomentar" class="d-block">
                       @csrf
                       <div class="form-group">
                           <input type="text" class="form-control" name='comment' placeholder="Komentar" required>

                       </div>
                       <button type="submit" class="btn btn-primary">Add Comment</button>
                   </form>

               </div>
           </div>
       </div>
   </div>

   <!--reply-->
   <div class="modal fade" id="modalreplykomen" tabindex="-1" role="dialog" aria-labelledby="modalreplykomenLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="postreplykomentar"></div>
               </div>
               <div class="modal-footer d-block">

                   <form action="" method="post" id="formreplykomentar" class="d-block">
                       @csrf
                       <div class="form-group">
                           <input type="text" class="form-control" name='replie' placeholder="replie" required>

                       </div>
                       <button type="submit" class="btn btn-primary">Reply</button>
                   </form>

               </div>
           </div>
       </div>
   </div>

   <!-- tweet. -->
   <div class="modal fade" id="modaledittweet" tabindex="-1" role="dialog" aria-labelledby="modaledittweetLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">

                   <div class="input-group-login" id="whathappen">
                       <div class="container">
                           <div class="part-1">
                               <div class="header">
                                 
                               </div>
                               <div class="text">
                                   <form class="" action="http://localhost/atter/tweet/post" method="post"
                                       enctype="multipart/form-data">
                                       @csrf
                                       <div class="inner">
                                           <img src="{{url('public/image/profil/'.auth()->user()->foto)}}"
                                               alt="profile photo">
                                           <label>
                                               <textarea class="text-whathappen" name="tweet" rows="8" cols="80"
                                                   maxlength="140" placeholder="What's happening?"
                                                   required=""></textarea>
                                           </label>
                                       </div>
                                       <!-- tmp image upload place -->
                                       <div class="position-relative upload-photo">
                                           <img class="img-upload-tmp" src="" alt="">
                                           <div class="icon-bg">
                                               <i id="#upload-delete-tmp"
                                                   class="fas fa-times position-absolute upload-delete" width="100%"
                                                   aria-hidden="true"></i>
                                           </div>
                                       </div>
                                       <div class="bottom">
                                           <div class="bottom-container">
                                               <label for="tweet_img" class="ml-3 mb-2 uni">
                                                   <!-- <i class="fa fa-image item1-pair" aria-hidden="true"></i> -->
                                               </label>
                                               <input class="tweet_img" id="tweet_img" type="file" name="img"
                                                   accept="image/*">
                                           </div>
                                           <div class="hash-box">
                                               <ul style="margin-bottom: 0;"></ul>
                                           </div>
                                           <div>

                                               <span class="bioCount" id="count">140</span>
                                               <input id="tweet-input" type="submit" value="Update" class="submit">
                                           </div>
                                       </div>
                                   </form>
                               </div>
                           </div>
                           <div class="part-2"></div>
                       </div>
                   </div>


               </div>
               <div class="modal-footer d-block">



               </div>
           </div>
       </div>
   </div>