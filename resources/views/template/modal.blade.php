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