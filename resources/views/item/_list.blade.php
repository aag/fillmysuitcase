<div id="list" ng-controller="ListCtrl">
    <div class="unpacked">
        <h3 ng-show="!!unpackedItems.length || !items.length">Not Packed</h3>
        <ul class="packing-list">
            <li ng-repeat="item in unpackedItems = (items | filter:{packed:false} | orderBy:'id')">
                <div class="row">
                    <form class="form-inline">
                        <div class="col-xs-2 col-sm-1">
                            <div class="checkbox-holder">
                                <input type="checkbox" class="check item-check" ng-model="item.packed" ng-change="checkChange(item)" dusk="unpacked-check-{% $index %}">
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-6 col-md-5 col-lg-4">
                            <input class="item-name" ng-model="item.name" ng-change="change(item)" dusk="unpacked-item-{% $index %}">
                        </div>
                        <div class="col-xs-2" ng-hide="item.confirmingDelete">
                            <div class="item-icon-holder">
                                <a href="" ng-click="delete(item)" ng-hide="item.justSaved" dusk="delete-item-link-{% $index %}">
                                    <img class="delete-icon" alt="Delete item" title="Delete item" src="{{ mix('img/cross.png') }}">
                                </a>
                                <img class="save-check" ng-show="item.justSaved" src="{{ mix('img/check.png') }}" alt="item saved" title="item saved">
                            </div>
                        </div>
                        <div class="col-xs-10 col-xs-offset-2 col-sm-5 col-sm-offset-0 col-md-6 col-lg-7" ng-show="item.confirmingDelete">
                            <div class="confirm-delete">
                                Are you sure?
                                <button class="delete-yes btn btn-danger" ng-click="confirmDelete(item)" dusk="confirm-delete-button-{% $index %}">Delete</button>
                                <button class="delete-cancel btn btn-default" ng-click="cancelDelete(item)">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li ng-show="!!unpackedItems.length || !items.length" class="new-item">
                <div class="row">
                    <form class="form-inline" ng-submit="submit()">
                        <div class="col-xs-2 col-sm-1"></div>
                        <div class="col-xs-7 col-sm-6 col-md-5 col-lg-4">
                            <input placeholder="New Item" class="item-name" ng-model="newName" dusk="new-item-input">
                        </div>
                        <div class="col-xs-3 col-sm-2">
                            <button type="submit" class="btn btn-default create-item-button" dusk="add-item-button">Add</button>
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
                    <button class="reset-list btn btn-primary" ng-click="resetPacked()" dusk="reset-button">Reset</button>
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
                        <div class="col-xs-2 col-sm-1">
                            <div class="checkbox-holder">
                                <input type="checkbox" class="check" ng-model="item.packed" ng-change="checkChange(item)" dusk="packed-check-{% $index %}">
                            </div>
                        </div>
                        <div class="col-xs-10 col-sm-11">
                            <div class="checked-item" dusk="packed-item-{% $index %}">{% item.name %}</div>
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

