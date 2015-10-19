<div id="list" ng-controller="ListCtrl">
    <div class="unpacked">
        <h3 ng-show="!!unpackedItems.length || !items.length">Not Packed</h3>
        <ul class="packing-list">
            <li ng-repeat="item in unpackedItems = (items | filter:{packed:false} | orderBy:'id')">
                <div class="row">
                    <form class="form-inline">
                        <div class="col-xs-1">
                            <input type="checkbox" class="check item-check" ng-model="item.packed" ng-change="checkChange(item)">
                        </div>
                        <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                            <input class="item-name" ng-model="item.name" ng-change="change(item)">
                        </div>
                        <div class="col-xs-2 col-sm-5 col-md-6 col-lg-7">
                            <a href="" ng-click="delete(item)" ng-hide="item.confirmingDelete">
                                <img class="delete-icon" alt="Delete item" title="Delete item" src="/img/cross.png">
                            </a>
                            <div class="confirm-delete" ng-show="item.confirmingDelete">
                                Are you sure?
                                <button class="delete-yes btn btn-danger" ng-click="confirmDelete(item)">Delete</button>
                                <button class="delete-cancel btn btn-default" ng-click="cancelDelete(item)">Cancel</button>
                            </div>
                            <img class="save-check" ng-show="item.justSaved" src="/img/check.png" alt="item saved" title="item saved">
                        </div>
                    </form>
                </div>
            </li>
            <li ng-show="!!unpackedItems.length || !items.length" class="new-item">
                <div class="row">
                    <form class="form-inline" ng-submit="submit()">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                            <input placeholder="New Item" class="item-name" ng-model="newName">
                        </div>
                        <div class="col-xs-2">
                            <button type="submit" class="btn btn-default create-item-button">Add</button>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
                <div class="packing-finished" ng-hide="!!unpackedItems.length || !items.length">
                    <h2>Bon voyage!</h2>
                    <p>Reset the list for your next trip.</p>
                    <button class="reset-list btn btn-primary" ng-click="resetPacked()">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div class="packed">
        <h3>Already Packed</h3>
        <ul class="packing-list already-packed">
            <li ng-repeat="item in items | filter:{packed:true} | orderBy:'id'">
                <div class="row">
                    <form class="form-inline">
                        <div class="col-xs-1">
                            <input type="checkbox" class="check" ng-model="item.packed" ng-change="checkChange(item)">
                        </div>
                        <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                            <div class="checked-item">{{ item.name }}</div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
        <div class="no-packed-message" ng-show="!!unpackedItems.length && (items.length - unpackedItems.length === 0)">
            <p>Nothing packed yet. Check off an item to move it here.</p>
        </div>
    </div>
</div>

