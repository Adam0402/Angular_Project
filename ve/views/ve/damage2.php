<div class="scrollable">
    <div class="scrollable-content">
        <div class="list-group text-center">
            <div class="list-group-item-home">
                <div>
                    <i class="fa fa-exclamation-triangle  feature-icon text-primary"></i>
                </div>
                <div>
                    <h3 class="home-heading">Select your Damage Level</h3>
                    <p>Select your Damage Level by mouse click</p>
                    <hr />
                    <div id="car_wrapper" class="car_wrapper_3">
                        <a ng-repeat="damage in damage_selected">
                            <img src="/ve/img/n_images/{{damage.depth_src}}/{{damage.depth_level}}.jpg" width="200" height="200">
                            <div style="margin-top:10px; margin-bottom:10px;">
                                <img src="/ve/img/n_images/{{damage.depth_src}}/level1.jpg" width="40" height="40" ng-click="level_change('level1', damage.select_id)">
                                <img src="/ve/img/n_images/{{damage.depth_src}}/level2.jpg" width="40" height="40" ng-click="level_change('level2', damage.select_id)">
                                <img src="/ve/img/n_images/{{damage.depth_src}}/level3.jpg" width="40" height="40" ng-click="level_change('level3', damage.select_id)">
                                <img src="/ve/img/n_images/{{damage.depth_src}}/level4.jpg" width="40" height="40" ng-click="level_change('level4', damage.select_id)">
                            </div>
                        </a>
                    </div>
                    <div id="next">
                        <hr/>
                        <a class="btn btn-primary btn-block" href="#/photos?ClaimID={{ClaimID}}">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
