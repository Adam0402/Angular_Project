<div class="scrollable">
    <div class="scrollable-content home">
        <div class="list-group text-center">
            <div class="list-group-item list-group-item-home">
                <h1>Automotive Incident Report <small>v2.4</small></h1>
            </div>
            <div class="list-group-item-home">
                <div>
                    <i class="fa fa-car feature-icon text-primary"></i>
                </div>
                <div>
                    <h3 class="home-heading">Enter your Claim # or VIN</h3>
                    You will be asked to provide photos and some basic information about the incident.
                    <form role="form">
                        <fieldset>
                            <div class="form-group has-success has-feedback">
                                <input type="text" class="form-control" placeholder="Claim # or VIN" ng-model="ClaimID">
                            </div>
                        </fieldset>
                        <hr>
                        <a class="btn btn-primary btn-block" ng-click="next()" href="#/vehicle?ClaimID={{ClaimID}}">Next</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
