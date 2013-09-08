<div id="list" ng-controller="ListCtrl">
    <div class="unpacked">
        <ul class="packing-list">
            <li ng-repeat="item in items | filter:{packed:false}">
                <form class="form-inline">
                    <input type="checkbox" class="check" ng-model="item.packed" ng-change="change(item)">
                    <input ng-model="item.name" ng-change="change(item)">
                </form>
            </li>
            <li class="new-item">
                <form class="form-inline" ng-submit="submit()">
                    <input placeholder="New Item" ng-model="newName">
                    <button type="submit">Create</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="packed">
        <h3>Already Packed</h3>
        <ul class="packing-list">
            <li ng-repeat="item in items | filter:{packed:true}">
                <form class="form-inline">
                    <input type="checkbox" class="check" ng-model="item.packed" ng-change="change(item)">
                    <input ng-model="item.name" ng-change="change(item)">
                </form>
            </li>
        </ul>
    </div>
</div>

