<?php
include './partials/header.php';
?>
<link rel="stylesheet" href="./CSS/contact.css">


<div class="container over__container">
    <div id="main" class="mx-2" style="text-align: justify; color: #8E95A5;">
        <div class="row contact__wrapper justify-content-center">
            <div class="col-xl-8 col-12 mb-xl-0 mb-4 contact__main">
                <div class="background__wrapper"></div>
                <form action="#" method="post" id="contact__form" class="contact__form">
                    <div class="form_title row">
                        <h2 class="text-center">Contact Us</h2>
                        <p class="text-center">
                            Matic is always listening to your feedbacks, let us stay in touch and answer your questions.
                        </p>
                    </div>
                    <hr>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Your Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="email@example.com" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="subject" name="subject" id="subject" title="Subject" tabindex="0 " required>
                                <option value="Service" class="text-dark">Service</option>
                                <option value="Watching" class="text-dark">Watching</option>
                                <option value="Download" class="text-dark">Download</option>
                                <option value="Upload" class="text-dark">Upload</option>
                                <option value="Others" class="text-dark">Others</option>
                            </select>
                            <!-- <input type="text" class="form-control" id="subject" autocomplete="off" placeholder="Service, Watching, Download,..."> -->
                        </div>
                    </div>
                    <div class="my-3 row">
                        <label for="contact__message" class="col-sm-2 form-label">Message:</label>
                        <div class="col-10">
                            <textarea id="contact__message" class="border-lighter-dark bg-lighter-dark form-control" rows="4" max="500" placeholder="Leave your message here" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row text-center d-flex justify-content-center">
                        <button type="submit" class="btn contact_btn" id="contact__submit_btn" style="color: #fff; width: 140px;">Submit Your Messages</button>
                    </div>
                </form>
            </div>
            <div class="col-xl-3 col-12 fw-normal text-lightgrey my-auto">
                <div class="location">
                    <span class="fw-bold">
                        Location:
                    </span> Campus II, 3/2 street, Ninh Kieu District, Can Tho City, Viet Nam.
                </div>
                <div class="tel">
                    <span class="fw-bold">Tel:</span>
                    (84-292) 1234567 - (84-292) 9876543
                    </br><span class="fw-bold">Fax:</span>
                    (84-292) 2345678.
                </div>
                <div class="connect__us">
                    <p class="fw-bold">Visit our social sites: </p>
                    <a href="https://www.facebook.com/" class="fa-stack fa-lg ">
                        <i class="fa fa-circle fa-stack-2x " style="color: #3B5998; "></i>
                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse "></i>
                    </a>
                    <a href="https://www.twitter.com/ " class="fa-stack fa-lg ">
                        <i class="fa fa-circle fa-stack-2x " style="color: #1DA1F2; "></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse "></i>
                    </a>
                    <a href="https://www.telegram.com/ " class="fa-stack fa-lg ">
                        <i class="fa fa-circle fa-stack-2x " style="color: #0088CC; "></i>
                        <i class="fas fa-paper-plane fa-stack-1x fa-inverse "></i>
                    </a>

                    <a href="https://www.linkedin.com/ " class="fa-stack fa-lg ">
                        <i class="fa fa-circle fa-stack-2x " style="color: #007BB5; "></i>
                        <i class="fa-brands fa-linkedin-in fa-stack-1x fa-inverse "></i>
                    </a>
                </div>
            </div>


        </div>
        <div class="modal fade" id="contacted" tabindex="-1" aria-labelledby="contacted" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="account_created_title">Thank you !</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">
                        We have received your message. Thanks for telling us your ideas.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Go to homepage</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("form#contact__form").submit(function(event) {
            event.preventDefault();
            var email = $("#email").val();
            var subject = $("#subject").val();
            var msg = $("#contact__message").val();
            msg = msg.replace(/(\r\n|\n|\r)/gm, "");
            $.ajax({
                url: "./partials/add_contact.php",
                type: "post",
                data: {
                    email: email,
                    subject: subject,
                    msg: msg
                },
                success: function(data) {
                    if (data == 1) {
                        $("#contact__form")[0].reset();
                        $("#contacted").modal("show");
                        $("#contacted").on("hidden.bs.modal", function() {
                            location.href = './index.php';
                        })
                    } else {
                        console.log("CODE NGUUUUU");
                    }
                }
            });
        });
    });
</script>
<?php
include './partials/footer.php';
?>