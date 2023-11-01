@extends('template.master')
@push('css')
<style>
    .textarea , .textarea::hover {
        font-size: 13px;
    }
</style>
@endpush
@section('content')
<div class="grid-toolbar-center">
    <div class="center-input-search">
        <div class="input-group-login" id="whathappen">
            <div class="container">
                <div class="part-1">
                    <div class="header">
                        <div class="home">
                            <h2>Home </h2>
                        </div>
                    </div>
                    <div class="text">
                        <form class="" action="handle/handleTweet.php" method="post" enctype="multipart/form-data">
                            <div class="inner">
                                <img src="" alt="profile photo">
                                <label>
                                    <textarea class="text-whathappen" name="status" rows="8" cols="80"
                                        placeholder="What's happening?"></textarea>
                                </label>
                            </div>
                            <!-- tmp image upload place -->
                            <div class="position-relative upload-photo">
                                <img class="img-upload-tmp" src="assets/images/tweets/tweet-60666d6b426a1.jpg" alt="">
                                <div class="icon-bg">
                                    <i id="#upload-delete-tmp" class="fas fa-times position-absolute upload-delete"></i>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="bottom-container">
                                    <label for="tweet_img" class="ml-3 mb-2 uni">
                                        <i class="fa fa-image item1-pair"></i>
                                    </label>
                                    <input class="tweet_img" id="tweet_img" type="file" name="tweet_img">
                                </div>
                                <div class="hash-box">
                                    <ul style="margin-bottom: 0;"></ul>
                                </div>
                                <div>

                                    <span class="bioCount" id="count">140</span>
                                    <input id="tweet-input" type="submit" name="tweet" value="Tweet" class="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="part-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection