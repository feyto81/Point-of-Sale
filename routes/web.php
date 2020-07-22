<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/login', 'HomeController@login')->name('login');
Route::post('/postlogin', 'HomeController@postlogin');
Route::get('/logout', 'HomeController@logout');

Route::group(['middleware' => ['auth', 'checkRole:1']], function () {

//route of supplier
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/logActivity', 'HomeController@logActivity');
	Route::get('test','HomeController@ApiLaporanBulanan');
	Route::get('/supplier/addsupplier', 'SupplierController@getAddsupplier');
	Route::post('/supplier/saveAdd', 'SupplierController@saveAddsupllier');
	Route::get('/supplier/all', 'SupplierController@getIndexsupplier');
	Route::get('/supplier/edit-supplier/{supplier_id}', 'SupplierController@getEditsupplier');
	Route::post('/supplier/update-supplier/{supplier_id}', 'SupplierController@getupdatesupplier');
	Route::get('/supplier/delete-supplier/{supplier_id}', 'SupplierController@getdeletecategory');
	Route::get('/supplier/export-excel','SupplierController@export_excel');
	Route::get('/supplier/export-pdf','SupplierController@export_pdf');
	Route::post('/supplier/import-excel','SupplierController@import_excel');

	//route of customer
	Route::get('/customer/addcustomer', 'CustomerController@getAddcustomer');
	Route::post('/customer/saveAdd', 'CustomerController@saveAddcustomer');
	Route::get('/customer/all', 'CustomerController@getIndexcustomer');
	Route::get('/customer/edit-customer/{customer_id}', 'CustomerController@getEditcustomer');
	Route::post('/customer/update-customer/{customer_id}', 'CustomerController@getupdatecustomer');
	Route::get('/customer/delete-customer/{customer_id}', 'CustomerController@getdeletecustomer');
	Route::get('/customer/export-excel','CustomerController@export_excel');
	Route::get('/customer/export-pdf','CustomerController@export_pdf');
	Route::post('/customer/import-excel','CustomerController@import_excel');

	//route of category
	Route::get('/categoryall', 'CategoryController@all_category');
	Route::get('/add-category', 'CategoryController@add_category');
	Route::post('save-category', 'CategoryController@save_category');
	Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
	Route::post('/update-category/{category_id}', 'CategoryController@update_category');
	Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');

	//route of unit
	Route::get('/unitall', 'UnitController@all_unit');
	Route::get('/add-unit', 'UnitController@add_unit');
	Route::post('save-unit', 'UnitController@save_unit');
	Route::get('/edit-unit/{unit_id}', 'UnitController@edit_unit');
	Route::post('/update-unit/{unit_id}', 'UnitController@update_unit');
	Route::get('/delete-unit/{unit_id}', 'UnitController@delete_unit');

	//route of items
	Route::get('/itemall', 'ItemController@all_item');
	Route::get('/add-item', 'ItemController@add_item');
	Route::post('save-item', 'ItemController@save_item');
	Route::get('/edit-item/{item_id}', 'ItemController@edit_item');
	Route::post('/update-item/{item_id}', 'ItemController@update_item');
	Route::get('/delete-item/{item_id}', 'ItemController@delete_item');
	Route::get('/print-barcode-qr-code/{item_id}', 'ItemController@barcodeqrcode');
	Route::get('/item/barcode-print/{item_id}', 'ItemController@print_barcode');
	Route::get('/item/qrcode-print/{item_id}', 'ItemController@print_qrcode');
	Route::get('/item/print-all-barcode', 'ItemController@print_all_barcode');
	Route::get('/item/print-all-qrcode', 'ItemController@print_all_qrcode');

	Route::get('/stock-in/all', 'StockController@all_stock_in');
	Route::get('/stock-in/add-stock-in', 'StockController@add_stock_in');
	Route::post('/stock-in/save-stock-in', 'StockController@save_stock_in');
	Route::get('/stock-in/delete-stock/{stock_id}', 'StockController@delete_stock_in');

	Route::get('/stock-out/all', 'StockController@all_stock_out');
	Route::get('/stock-out/add-stock-out', 'StockController@add_stock_out');
	Route::post('/stock-out/save-stock-out', 'StockController@save_stock_out');
	Route::get('/stock-out/delete-stock/{stockout_id}', 'StockController@delete_stock_out');

	Route::get('/sales/all', 'TransactionController@all_sales');
	Route::post('/sales/cart', 'TransactionController@save_cart');
	Route::get('/sales/delete-cart/{cart_id}', 'TransactionController@delete_cart');
	Route::post('/sales/transaction', 'TransactionController@kirim_semua');
	Route::get('/sale/cetak/{sale_id}', 'TransactionController@print');
	Route::get('/sales/getDataTable','TransactionController@get');
	Route::post('sales/EditData/{cart_id}','TransactionController@update');

	// route of report day
	Route::get('/report/day','ReportController@day');
	Route::get('/report/day/search','ReportController@day_search');
	Route::get('/report/sale/dayp','ReportController@day_p');
	Route::get('/report/sale/cetakpdf/','ReportController@day_pdf');

	//route of report month
	Route::get('/report/month','ReportController@month');
	Route::get('/report/sale/month','ReportController@month_search');
	Route::get('/report/sale/monthp','ReportController@month_p');
	Route::get('/report/sale/cetakmonthpdf/','ReportController@month_pdf');

	//route of report year
	Route::get('/report/year','ReportController@year');
	Route::get('/report/sale/year','ReportController@year_search');
	Route::get('/report/sale/yearp','ReportController@year_p');
	Route::get('/report/sale/cetakyearpdf/','ReportController@year_pdf');

	Route::get('/user/all','UserController@all_user');
	Route::post('/user/add','UserController@add_user');
	Route::get('/user/delete/{id}','UserController@delete_user');
	Route::get('/user/edit-user/{id}','UserController@edit_user');
	Route::post('/user/update-user/{id}','UserController@update_user');

	//route of profil
	Route::get('/profile', 'ProfileController@index');
	Route::put('/update-password', 'ProfileController@updatepassword');
	Route::post('/update-profile', 'ProfileController@updateProfile');

	// Route::get('/finance/pemasukan/all','PemasukanController@getIndexPemasukan');
	// Route::post('/pemasukan/add','PemasukanController@add_pemasukan');
	// Route::get('/pemasukan/delete-pemasukan/{pemasukan_id}','PemasukanController@delete_pemasukan');
	// Route::get('/pemasukan/edit-pemasukan/{pemasukan_id}','PemasukanController@edit_pemasukan');
	// Route::post('/pemasukan/update-pemasukan/{pemasukan_id}','PemasukanController@update_pemasukan');
	// Route::get('/pemasukan/export-excel','PemasukanController@export_excel');
	// Route::get('/pemasukan/export-pdf','PemasukanController@export_pdf');

	Route::get('/finance/pengeluaran/all','PengeluaranController@getIndexPengeluaran');
	Route::post('/pengeluaran/add','PengeluaranController@add_pengeluaran');
	Route::get('/pengeluaran/delete-pengeluaran/{pemasukan_id}','PengeluaranController@delete_pengeluaran');
	Route::get('/pengeluaran/edit-pengeluaran/{pengeluaran_id}','PengeluaranController@edit_pengeluaran');
	Route::post('/pengeluaran/update-pengeluaran/{pengeluaran_id}','PengeluaranController@update_pengeluaran');
	Route::get('/pengeluaran/export-excel','PengeluaranController@export_excel');
	Route::get('/pengeluaran/export-pdf','PengeluaranController@export_pdf');

	Route::get('finance/akumulasi/all','KeuanganController@getIndexAkumulasi');
});
Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
	Route::get('/sales/all', 'TransactionController@all_sales');
	Route::post('/sales/cart', 'TransactionController@save_cart');
	Route::get('/sales/delete-cart/{cart_id}', 'TransactionController@delete_cart');
	Route::post('/sales/transaction', 'TransactionController@kirim_semua');
	Route::get('/sale/cetak/{sale_id}', 'TransactionController@print');
	Route::get('/sales/getDataTable','TransactionController@get');
	Route::post('sales/EditData/{cart_id}','TransactionController@update');

	Route::get('/finance/pemasukan/all','PemasukanController@getIndexPemasukan');
	Route::post('/pemasukan/add','PemasukanController@add_pemasukan');
	Route::get('/pemasukan/delete-pemasukan/{pemasukan_id}','PemasukanController@delete_pemasukan');
	Route::get('/pemasukan/edit-pemasukan/{pemasukan_id}','PemasukanController@edit_pemasukan');
	Route::post('/pemasukan/update-pemasukan/{pemasukan_id}','PemasukanController@update_pemasukan');

	Route::get('/finance/pengeluaran/all','PengeluaranController@getIndexPengeluaran');
	Route::post('/pengeluaran/add','PengeluaranController@add_pengeluaran');
	Route::get('/pengeluaran/delete-pengeluaran/{pemasukan_id}','PengeluaranController@delete_pengeluaran');
	Route::get('/pengeluaran/edit-pengeluaran/{pengeluaran_id}','PengeluaranController@edit_pengeluaran');
	Route::post('/pengeluaran/update-pengeluaran/{pengeluaran_id}','PengeluaranController@update_pengeluaran');

	Route::get('finance/akumulasi/all','KeuanganController@getIndexAkumulasi');

	Route::get('/stock-in/all', 'StockController@all_stock_in');
	Route::get('/stock-in/add-stock-in', 'StockController@add_stock_in');
	Route::post('/stock-in/save-stock-in', 'StockController@save_stock_in');
	Route::get('/stock-in/delete-stock/{stock_id}', 'StockController@delete_stock_in');

	Route::get('/stock-out/all', 'StockController@all_stock_out');
	Route::get('/stock-out/add-stock-out', 'StockController@add_stock_out');
	Route::post('/stock-out/save-stock-out', 'StockController@save_stock_out');
	Route::get('/stock-out/delete-stock/{stockout_id}', 'StockController@delete_stock_out');
});
Route::group(['middleware' => ['auth', 'checkRole:1,3']], function () {
	// route of report day
	Route::get('/report/day','ReportController@day');
	Route::get('/report/day/search','ReportController@day_search');
	Route::get('/report/sale/dayp','ReportController@day_p');
	Route::get('/report/sale/cetakpdf/','ReportController@day_pdf');

	//route of report month
	Route::get('/report/month','ReportController@month');
	Route::get('/report/sale/month','ReportController@month_search');
	Route::get('/report/sale/monthp','ReportController@month_p');
	Route::get('/report/sale/cetakmonthpdf/','ReportController@month_pdf');

	//route of report year
	Route::get('/report/year','ReportController@year');
	Route::get('/report/sale/year','ReportController@year_search');
	Route::get('/report/sale/yearp','ReportController@year_p');
	Route::get('/report/sale/cetakyearpdf/','ReportController@year_pdf');
});
Route::group(['middleware' => ['auth', 'checkRole:1,2,3']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	//route of profil
	Route::get('/profile', 'ProfileController@index');
	Route::put('/update-password', 'ProfileController@updatepassword');
	Route::post('/update-profile', 'ProfileController@updateProfile');
});
