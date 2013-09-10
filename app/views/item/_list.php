<div id="list" ng-controller="ListCtrl">
    <div class="unpacked">
        <h3>Not Packed</h3>
        <ul class="packing-list">
            <li ng-repeat="item in items | filter:{packed:false}">
                <form class="form-inline">
                    <div class="check-holder">
                        <input type="checkbox" class="check" ng-model="item.packed" ng-change="change(item)">
                    </div>
                    <input class="item-name" ng-model="item.name" ng-change="change(item)">
                    <a href="" ng-click="delete(item)" ng-hide="item.confirmingDelete">
                        <img class="delete-icon" alt="Delete item" title="Delete item" src="/img/cross.png">
                    </a>
                    <div class="confirm-delete" ng-show="item.confirmingDelete">
                        Are you sure?
                        <button class="delete-yes" ng-click="confirmDelete(item)">Delete</button>
                        <button class="delete-cancel" ng-click="cancelDelete(item)">Cancel</button>
                    </div>
                </form>
            </li>
            <li class="new-item">
                <form class="form-inline" ng-submit="submit()">
                    <div class="check-holder"></div>
                    <input placeholder="New Item" class="item-name" ng-model="newName">
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
                    <div class="checked-item">{{ item.name }}</div>
                </form>
            </li>
        </ul>
    </div>
</div>

