<div id="list" ng-controller="ListCtrl">
    <div class="unpacked">
        <h3 ng-show="!!unpackedItems.length">Not Packed</h3>
        <ul class="packing-list">
            <li ng-repeat="item in unpackedItems = (items | filter:{packed:false})">
                <form class="form-inline">
                    <div class="check-holder">
                        <input type="checkbox" class="check" ng-model="item.packed" ng-change="checkChange(item)">
                    </div>
                    <input class="item-name" ng-model="item.name" ng-change="change(item)">
                    <a href="" ng-click="delete(item)" ng-hide="item.confirmingDelete">
                        <img class="delete-icon" alt="Delete item" title="Delete item" src="/img/cross.png">
                    </a>
                    <div class="confirm-delete" ng-show="item.confirmingDelete">
                        Are you sure?
                        <button class="delete-yes btn btn-danger" ng-click="confirmDelete(item)">Delete</button>
                        <button class="delete-cancel btn" ng-click="cancelDelete(item)">Cancel</button>
                    </div>
                </form>
            </li>
            <li ng-show="!!unpackedItems.length" class="new-item">
                <form class="form-inline" ng-submit="submit()">
                    <div class="check-holder"></div>
                    <input placeholder="New Item" class="item-name" ng-model="newName">
                    <button type="submit" class="btn">Create</button>
                </form>
            </li>
        </ul>
        <div class="packing-finished" ng-hide="!!unpackedItems.length">
            <h4>Everything is packed. Bon voyage!</h4>
            <p>Reset the list for your next trip.</p>
            <button class="reset-list btn btn-primary" ng-click="resetPacked()">Reset</button>
        </div>
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

