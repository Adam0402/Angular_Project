<style>
    .sample_img 
    {
        -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
        filter: grayscale(100%);
    }
    .sample_text
    {
        top: -122px;
        position: relative;
        font-size: 24px;
        font-weight: bold;
        color: #000;
       -webkit-text-stroke-width: 1px;
       -webkit-text-stroke-color: #FFF;
    }
</style>
<form enctype='multipart/form-data'>
    <div class="scrollable">
        <div class="scrollable-content">
            <div class="list-group text-center">
                <div class="list-group-item-home">
                    <div>
                        <i class="fa fa-picture-o  feature-icon text-primary"></i>
                    </div>
                    <div>
                        <h3 class="home-heading">Add Photos</h3>
                        <div class="section">
                            <div class="panel-group" ui-shared-state="myAccordion" ui-default='1'>
                            <photos></photos>
                            </div>
                            <div >
                                <hr/>
                                <a class="btn btn-primary btn-block" href="#/thankyou?ClaimID={{ClaimID}}">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>