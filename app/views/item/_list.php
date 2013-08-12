<div id="list" ng-controller="ListCtrl">
    <div class="unpacked">
        <ul class="packing-list">
            <li ng-repeat="item in items | filter:{packed:false}">
                <form class="form-inline">
                    <input type="checkbox" class="check" ng-model="item.packed">
                    <input ng-model='item.name'> (added {{item.created_at|date}})
                </form>
            </li>
        </ul>
    </div>

    <div class="packed">
        <h3>Already Packed</h3>
        <ul class="packing-list">
            <li ng-repeat="item in items | filter:{packed:true}">
                <form class="form-inline">
                    <input type="checkbox" class="check" ng-model="item.packed">
                    <input ng-model='item.name'> (added {{item.created_at|date}})
                </form>
            </li>
        </ul>
    </div>
</div>

