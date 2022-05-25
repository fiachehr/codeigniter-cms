<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| Display Debug backtrace

|--------------------------------------------------------------------------

|

| If set to TRUE, a backtrace will be displayed along with php errors. If

| error_reporting is disabled, the backtrace will not display, regardless

| of this setting

|

*/

defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);



/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);

defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);

defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);

defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/

defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');

defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');

defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care

defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care

defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');

defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');

defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');

defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');



/*

|--------------------------------------------------------------------------

| Exit Status Codes

|--------------------------------------------------------------------------

|

| Used to indicate the conditions under which the script is exit()ing.

| While there is no universal standard for error codes, there are some

| broad conventions.  Three such conventions are mentioned below, for

| those who wish to make use of them.  The CodeIgniter defaults were

| chosen for the least overlap with these conventions, while still

| leaving room for others to be defined in future versions and user

| applications.

|

| The three main conventions used for determining exit status codes

| are as follows:

|

|    Standard C/C++ Library (stdlibc):

|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html

|       (This link also contains other GNU-specific conventions)

|    BSD sysexits.h:

|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits

|    Bash scripting:

|       http://tldp.org/LDP/abs/html/exitcodes.html

|

*/

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors

defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error

defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error

defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found

defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class

defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member

defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input

defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error

defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code

defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/*

|--------------------------------------------------------------------------

| Modules Folders Constants

|--------------------------------------------------------------------------

*/

define('CKEDITOR','../../../');

define('AVATAR', getcwd().'/assets/uploads/admin_avatar/');

define('CATEGORY', getcwd().'/assets/uploads/category/');

define('NEWS', getcwd().'/assets/uploads/news/');

define('ATTACHMENT', getcwd().'/assets/uploads/category_attachment/');

define('PRODUCT', getcwd().'/assets/uploads/product/');

define('CAT_ATTACHMENT', getcwd().'/assets/uploads/attachment/');

define('HOMEPAGE', getcwd().'/assets/uploads/homepage/');

define('SLIDER', getcwd().'/assets/uploads/slider/');
define('BOARD', getcwd().'/assets/uploads/board/');


define('QRCODE_FOLDER', getcwd().'/assets/uploads/qrcode/');





/*

|--------------------------------------------------------------------------

| Custom Error Messages

|--------------------------------------------------------------------------

*/

define('GROUP_DATA_ERROR', "خطا در ثبت یا تغییر اطلاعات");

define('ACCESS_CONTROL', "عدم دسترسی");

define('DATA_INSERT_ERROR', "اطلاعات مورد نظر شما ثبت نگردید");

define('DATA_UPDATE_ERROR', "تغییرات مورد نظر شما ثبت نگردید");

define('GROUP_DATA_SUCCESS', "موفقیت ثبت یا تغییر اطلاعات");

define('DATA_INSERT_SUCCESS', "اطلاعات مورد نظر شما ثبت گردید");

define('DATA_UPDATE_SUCCESS', "تغییرات مورد نظر شما ثبت گردید");

define('DATE_ERROR', "تاریخ آغاز از تاریخ پایان کوچکتر است");

define('PASS_ERROR', "رمز عبور تغییر پیدا نکرد");

define('CHANGE_PASS', "رمز عبور تغییر پیدا کرد");

define('DIFF_PASS', "کلمه عبور با تکرار آن برابر نیست");

define("FIRST_ENTER_SUCCESS","رمز عبور با موفقیت تغییر پیدا کرد لطفا دوباره وارد شوید");

define("DONT_ACCESS_MODULE","شما مجوز دسترسی به این بخش را ندارید");

define("DONT_ACCESS_DATA","شما مجوز ویرایش، درج یا حذف اطلاعات را ندارید");



/*

|--------------------------------------------------------------------------

| Mail Constant

|--------------------------------------------------------------------------

*/

define('PROTOCOL','smtp');

define('SMTP_HOST','');

define('SMTP_PORT','25');

define('SMTP_USERNAME','');

define('SMTP_PASSWORD','');

define('CHARSET','utf-8');

define('NEWLINE','\r\n');

define('MAILTYPE','html');



