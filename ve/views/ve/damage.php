<div class="scrollable">
    <div class="scrollable-content">
        <div class="list-group text-center">
            <div class="list-group-item-home">
                <div>
                    <i class="fa fa-exclamation-triangle  feature-icon text-primary"></i>
                </div>
                <div>
                    <h3 class="home-heading">Select your Damage</h3>
                    <p>Touch the damage area.  If multiple areas are damaged, select the first area.</p>
                    <label for="repeatSelect"> Damaged Count: </label>
                    <select name="repeatSelect" id="repeatSelect" ng-model="selected_count.count" ng-change="count_update()">
                        <option ng-repeat="option in selected_count.availableOptions" value="{{option.id}}">{{option.name}}</option>
                    </select>
                    <hr />
                    <div id="car_wrapper" class="car_wrapper_3" >         
                        <div ng-repeat="damage in damage_selected" style="margin-bottom:10px;">               
                            <map name="{{damage.usemap}}" >
                                <img src="{{damage.src}}" border="0" name="maincar" id="maincar" usemap="#{{damage.usemap}}">
                                <area ng-repeat="coord in area_code" shape="poly" id="{{coord.id}}" coords="{{coord.coords}}" title="{{coord.title}}" ng-click="selectPanel(coord.id, damage.select_id)">
                                <area shape="default" nohref="nohref" alt="">
                            </map>
                        </div>
                    </div>
                    <div>
                        <hr/>
                        <a class="btn btn-primary btn-block" ng-disabled="!all_selected" ng-click="go('/damage2')">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
