<?php
include './partials/header.php';

echo '
        <div class="container over__container" style="color: #8E95A5;">
            <div id="main" >
                <div class="upload__header mb-5">
                    <h2 class="text-center">Upload your movies</h2>
                    <h6 class="text-center fw-light">(Please complete the fields below)</h6>
                </div>
                <form method="POST" id="upload__form" class="row" enctype="multipart/form-data">   
                    <div class="mb-3 col-6" style="color: #8E95A5;">
                        <label for="upload__movie__name" class="form-label">Movie name:</label>
                        <input required id="upload__movie__name" name="upload__movie__name" type="text" class="border-lighter-dark bg-lighter-dark form-control" placeholder="Movie X">
                    </div>
                    <div class="mb-3 col-sm-3 col-6">
                        <label for="upload__release__time" class="form-label">Release:</label>
                        <input required id="upload__release__time" name="upload__release__time" type="date" class="border-lighter-dark bg-lighter-dark form-control" placeholder="yyyy-mm-dd">
                    </div>
                    <div class="mb-3 col-sm-3 col-6">
                        <label for="upload__genre" class="form-label">Genre:</label>
                        <select required id="multiple__genre"  class="border-lighter-dark bg-lighter-dark form-control selectpicker w-100" multiple aria-label="size 3 select example">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Biography">Biography</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Crime">Crime</option>
                            <option value="Documentary">Documentary</option>
                            <option value="Drama">Drama</option>
                            <option value="Family">Family</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="History">History</option>
                            <option value="Horror">Horror</option>
                            <option value="Kids">Kids</option>
                            <option value="Music">Music</option>                            
                            <option value="Mystery">Mystery</option>
                            <option value="News">News</option>
                            <option value="Reality">Reality</option>
                            <option value="Romance">Romance</option>
                            <option value="ScienceFiction">Science Fiction</option>
                            <option value="Soap">Soap</option>
                            <option value="Talk">Talk</option>
                            <option value="Thriller">Thriller</option>
                            <option value="War">War</option>
                        </select>
                        <input type="hidden" id="upload__genre" name="upload__genre">
                    </div>
                    <div class="mb-3 col-sm-8 col-6">
                        <label for="upload__casts" class="form-label">Casts:</label>
                        <input type="text" required id="upload__casts" name="upload__casts" class="border-lighter-dark bg-lighter-dark form-control" placeholder="Barbara, Denis...">
                    </div>
                    <div class="mb-3 col-sm-2 col-3">
                        <label for="upload__quality" class="form-label">Quality:</label>
                        <select required id="upload__quality" name="upload__quality" class="border-lighter-dark bg-lighter-dark form-control form-select" aria-label="Defaultselect" placeholder="Action.Thriller,..">
                            <option selected value="fullhd">Full HD</option>
                            <option value="hd">HD</option>
                            <option value="2k">2K</option>
                            <option value="4k">4K</option>
                        </select>
                    </div>
                    <div class="mb-3 col-sm-2 col-3">
                        <label for="upload__duration" class="form-label">Duration:</label>
                        <input required id="upload__duration" name="upload__duration" class="border-lighter-dark bg-lighter-dark form-control" placeholder="Your movie duration">
                    </div>
                    <div class="mb-3 col-sm-4 col-6">
                        <label for="upload__link" class="form-label">Movie file:</label>
                        <input required id="upload__link" type="file" name="upload__link" accept="video/*" class="border-lighter-dark bg-lighter-dark form-control">
                    </div>
                    <div class="mb-3 col-sm-4 col-6">
                        <label for="upload__background" class="form-label">Background:</label>
                        <input required id="upload__background" name="upload__background" accept="image/*" type="file" class="border-lighter-dark bg-lighter-dark form-control" placeholder="Recommendation: 3:2">
                    </div>
                    <div class="mb-3 col-sm-4 col-6">
                        <label for="upload__poster" class="form-label">Poster:</label>
                        <input required id="upload__poster" name="upload__poster" accept="image/*" type="file" class="border-lighter-dark bg-lighter-dark form-control" placeholder="Recommendation: 5:3">
                    </div>
                    
                    <div class="mb-3 col-12">
                        <label for="upload__overview" class="form-label">Overview:</label>
                        <textarea type="text" id="upload__overview"name="upload__overview" class="border-lighter-dark bg-lighter-dark form-control" rows="6" placeholder="Type your movie overview here"></textarea>
                    </div>
                    
                    <div class="mb-3 col-sm-3 d-none">
                        <label for="upload__rating" class="form-label">Rating:</label>
                        <input required id="upload__rating" name="upload__rating" type="text" value="0" class=" border-lighter-dark bg-lighter-dark form-control" placeholder="Service, Watching, Download,...">
                    </div>
                    
                    <h6 class="text-center mb-4">
                        By clicking the Upload button, default you have read and agree to all of our policies and terms.
                    </h6>
                    <button id="upload__button" type="submit" class="w-50 mx-auto btn btn-orange text-lightgrey" style="box-shadow: none !important;">Upload</button>
                </form> 
            </div>
            <div class="position-fixed bottom-0 end-0 p-3">
                <div class="toast fade" id="upload__Toast">
                    <div class="toast-header bg-success">
                        <strong class="me-auto text-white">Upload successfully !!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body bg-lighter-blue" style="color: white;">
                        Your movie has successfully uploaded, Now you can check it in the manager section.
                    </div>
                </div>
            </div>
        </div>';

include './partials/footer.php';
