<div class="scrollable">
    <div class="scrollable-content">
        <div class="list-group text-center">        
            <div class="list-group-item-home">
                <div>
                    <i class="fa fa-car feature-icon text-primary"></i>
                </div>
                <div>
                    <h3 class="home-heading">Confirm your Vehicle</h3>                
                    <br />                
                    <table class="table" style="width: 80%; margin: 0 auto;">
                        <tr>
                            <th>VIN</th>
                            <td><?php echo $claim['AutoVIN']; ?></td>
                        </tr>
                        <tr>
                            <th>Make</th>
                            <td><?php echo $claim['Make']; ?></td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td><?php echo $claim['Model']; ?></td>
                        </tr>
                        <tr>
                            <th>License</th>
                            <td><?php echo $claim['AutoLicense']; ?></td>
                        </tr>
                        <tr>
                            <th>Miles</th>
                            <td><?php echo number_format($claim['AutoMileage']); ?></td>
                        </tr>
                    </table>                    
                    <br/>                    
                    <div>
                        <a class="btn btn-primary btn-block" href="#/damage?ClaimID={{ClaimID}}">
                          Next
                        </a>                    
                        <small><a href="#" style="margin-top: 22px;">This is not my vehicle</a></small>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
