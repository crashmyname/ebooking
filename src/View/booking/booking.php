<section class="section">
    <div class="section-header">
        <h1>Item</h1>
    </div>

    <div class="section-body">
        <b>Item Expenses</b>
    </div>
    <?php $user = \Support\Session::user(); ?>
    <div class="card-body">
        <?php foreach($user->menus as $menu): ?>
        <?= $menu->menu_id == 4 && $menu->can_create == 1 ? '<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add <i class="fas fa-box"></i></button> <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalImport">Import <i class="far fa-file-excel"></i></button>' : '' ?>
        <?= $menu->menu_id == 4 && $menu->can_update == 1 ? '<button class="btn btn-warning" data-toggle="modal" data-target="" id="modalupdateitem">Edit <i class="far fa-edit"></i></button>' : '' ?>
        <?= $menu->menu_id == 4 && $menu->can_delete == 1 ? '<button class="btn btn-danger" type="submit" id="deleteitem">Delete <i class="fas fa-trash"></i></button> <button type="button" class="btn btn-disabled btn-danger btn-progress" id="loadingdelete" style="display:none">Save changes</button>' : '' ?>
        <?= $menu->menu_id == 4 && $menu->can_view == 1 ? '<button class="btn btn-success" type="submit" id="exportexcel">Export Excel <i class="fas fa-file-excel"></i></button> <button class="btn btn-dark" id="print">Print <i class="fas fa-print"></i></button> <button class="btn btn-outline-danger" id="exportpdf">Export PDF <i class="far fa-file-pdf"></i></button>' : '' ?>
        <?php endforeach; ?>
    </div>
    <div class="card-body">
        <table id="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Group</th>
                    <th>Harga</th>
                    <th>Code Category</th>
                    <th>Unit</th>
                    <th>Validity</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Item Name</th>
                    <th>Group</th>
                    <th>Harga</th>
                    <th>Code Category</th>
                    <th>Unit</th>
                    <th>Validity</th>
                </tr>
            </tfoot>
        </table>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formadditem" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <label>Item Name</label>
                            <input type="text" name="item_name" id="item_name" class="form-control">
                            <label>Group Item</label>
                            <input type="text" name="group_item" id="group_item" class="form-control">
                            <label>Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control">
                            <label>Code Category</label>
                            <input list="datalist" name="code_category" id="code_category" class="form-control">
                            <datalist id="datalist">
                                <option value="" disabled selected hidden> Select </option>
                                <?php foreach($code as $data):?>
                                    <option value="<?= $data->code_category?>"><?= $data->code_category?></option>
                                <?php endforeach; ?>
                            </datalist>
                            <label>Unit</label>
                            <select name="unit" id="unit" class="form-control">
                                <option value="" disabled selected hidden> Select </option>
                                <?php foreach($unit as $data):?>
                                    <option value="<?= $data->unit?>"><?= $data->unit?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="additem">Save changes</button>
                    <button type="button" class="btn btn-disabled btn-primary btn-progress" id="loading" style="display:none">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalImport">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formimportitem" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <label>Masukkan File Import Item</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="importitem">Save changes</button>
                    <button type="button" class="btn btn-disabled btn-primary btn-progress" id="loadingimport" style="display:none">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModalEdit">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="POST" id="formupdateitem" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <?= csrf() ?>
                            <?= method('PUT') ?>
                            <label>Item Name</label>
                            <input type="text" name="item_name" id="uitem_name" class="form-control">
                            <label>Group Item</label>
                            <input type="text" name="group_item" id="ugroup_item" class="form-control">
                            <label>Harga</label>
                            <input type="number" name="harga" id="uharga" class="form-control">
                            <label>Code Category</label>
                            <input list="datalist" name="code_category" id="ucode_category" class="form-control">
                            <datalist id="datalist">
                                <!-- <option value="" id=""> </option> -->
                                <?php foreach($code as $data):?>
                                    <option value="<?= $data->code_category?>"><?= $data->code_category?></option>
                                <?php endforeach; ?>
                            </datalist>
                            <label>Unit</label>
                            <select name="unit" id="uunit" class="form-control">
                                <!-- <option value="" disabled selected hidden> Select </option> -->
                                <?php foreach($unit as $data):?>
                                    <option value="<?= $data->unit?>"><?= $data->unit?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row-body">
                            <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" id="updateitem">Save changes</button>
                    <button type="button" class="btn btn-disabled btn-warning btn-progress" id="loadingupdate" style="display:none">Loading ..</button>
                </div>
            </div>
        </form>
    </div>
</div>