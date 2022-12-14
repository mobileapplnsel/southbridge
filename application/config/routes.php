<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 							= 'Frontend/Home/index';
$route['404_override'] 									= 'Admin/Auth/get404';
$route['translate_uri_dashes'] 							= FALSE;


// Frontend

$route['about-us'] 										= 'Frontend/Home/about_us';

//admin panel>>

//login
$route['admin'] 										= 'Admin/Auth/index';
$route['admin/login'] 									= 'Admin/Auth/onSetLogin';
$route['admin/chk_login'] 								= 'Admin/Auth/onCheckLogin';
$route['admin/chklogin2fa'] 							= 'Admin/Auth/onCheck2FAuth';
$route['admin/logout'] 									= 'Admin/Auth/onSetLogout';
$route['admin/dashboard'] 								= 'Admin/Auth/onGetDashboard';
$route['admin/send-password-recovery'] 					= 'Admin/Auth/onSendPasswordRecovery';

$route['admin/edit-admin-profile'] 						= 'Admin/Users/edit_admin_profile';
$route['admin/update-admin-profile'] 					= 'Admin/Users/update_admin_profile';
$route['admin/update-admin-password'] 					= 'Admin/Users/update_admin_password';
$route['admin/change-password'] 						= 'Admin/Users/change_admin_password';
$route['admin/verify-old-password'] 					= 'Admin/Users/verify_old_password';
	
//user management	
$route['admin/users'] 									= 'Admin/Users/index';
$route['admin/duplicate_check_un'] 						= 'Admin/Users/onCheckDuplicateUser';
$route['admin/duplicate_check_phone'] 					= 'Admin/Users/onCheckDuplicatePhone';
$route['admin/add-user'] 								= 'Admin/Users/onCreateUserView';
$route['admin/createuser'] 								= 'Admin/Users/onCreateUser';
$route['admin/profile'] 								= 'Admin/Users/onGetUserProfile/';
$route['admin/profile/(:any)'] 							= 'Admin/Users/onGetUserProfile/$1';
$route['admin/changeprofile'] 							= 'Admin/Users/onChangeUserProfile';
$route['admin/deluser'] 								= 'Admin/Users/onDeleteUser';
$route['admin/enable2fa'] 								= 'Admin/Users/onGetTwoFACode';
$route['admin/set2fa'] 									= 'Admin/Users/onSet2FAuth';
		
$route['admin/get_states'] 								= 'Admin/Users/getStates';
$route['admin/get_cities'] 								= 'Admin/Users/getCities';

//category management	
$route['admin/user-category-management'] 				= 'Admin/Category_Management/index';
$route['admin/add-user-category'] 						= 'Admin/Category_Management/onCreateCategoryView';
$route['admin/duplicate_category_check_un'] 			= 'Admin/Category_Management/onCheckDuplicateCategory';
$route['admin/create-user-category'] 					= 'Admin/Category_Management/onCreateCategory';
$route['admin/edit-user-category'] 						= 'Admin/Category_Management/onGetCategory/';
$route['admin/edit-user-category/(:any)'] 				= 'Admin/Category_Management/onGetCategory/$1';
$route['admin/update-user-category'] 					= 'Admin/Category_Management/updateCategory';
$route['admin/delete-user-category'] 					= 'Admin/Category_Management/deleteCategory';
$route['admin/update-category-status-ajax'] 			= 'Admin/Category_Management/updateCategoryStatusAjax';

//service category management	
$route['admin/service-category-management'] 			= 'Admin/Service_Category_Management/index';
$route['admin/add-service-category'] 					= 'Admin/Service_Category_Management/onCreateServiceCategoryView';
$route['admin/duplicate_service_category_check_un'] 	= 'Admin/Service_Category_Management/onCheckDuplicateServiceCategory';
$route['admin/create-service-category'] 				= 'Admin/Service_Category_Management/onCreateServiceCategory';
$route['admin/edit-service-category'] 					= 'Admin/Service_Category_Management/onGetServiceCategory/';
$route['admin/edit-service-category/(:any)'] 			= 'Admin/Service_Category_Management/onGetServiceCategory/$1';
$route['admin/update-service-category'] 				= 'Admin/Service_Category_Management/updateServiceCategory';
$route['admin/delete-service-category'] 				= 'Admin/Service_Category_Management/deleteServiceCategory';
$route['admin/update-service-category-status-ajax'] 	= 'Admin/Service_Category_Management/updateServiceCategoryStatusAjax';

//service management	
$route['admin/service-list'] 							= 'Admin/Service_Management/index';
$route['admin/add-service'] 							= 'Admin/Service_Management/add_service';
$route['admin/create-service'] 							= 'Admin/Service_Management/create_service';
$route['admin/edit-service'] 							= 'Admin/Service_Management/edit_service/';
$route['admin/edit-service/(:any)'] 					= 'Admin/Service_Management/edit_service/$1';
$route['admin/update-service'] 							= 'Admin/Service_Management/update_service';
$route['admin/update-service-status-ajax'] 				= 'Admin/Service_Management/updateServiceStatusAjax';

//Subcription Management	
$route['admin/package-list'] 							= 'Admin/Subcription_Management/index';
$route['admin/add-package'] 							= 'Admin/Subcription_Management/add_package';
$route['admin/create-package'] 							= 'Admin/Subcription_Management/create_package';
$route['admin/edit-package'] 							= 'Admin/Subcription_Management/edit_package/';
$route['admin/edit-package/(:any)'] 					= 'Admin/Subcription_Management/edit_package/$1';
$route['admin/update-package'] 							= 'Admin/Subcription_Management/update_package';
$route['admin/update-package-status-ajax'] 				= 'Admin/Subcription_Management/updatePackageStatusAjax';
$route['admin/subcribed-users-list'] 					= 'Admin/Subcription_Management/subcribed_users_list';


//Enquery Management	
$route['admin/enquery-list'] 							= 'Admin/Enquery_Management/index';
$route['admin/update-enquery-status-ajax'] 				= 'Admin/Enquery_Management/updateEnqueryStatusAjax';
$route['admin/enquiry-details/(:any)'] 					= 'Admin/Enquery_Management/enquiry_details/$1';
$route['admin/update-comment-status-ajax'] 				= 'Admin/Enquery_Management/updateCommentStatusAjax';


//Enquery Management	
$route['admin/cms'] 									= 'Admin/CMS_Management/index';
$route['admin/edit-cms/(:any)'] 						= 'Admin/CMS_Management/edit_cms/$1';
$route['admin/update-cms'] 								= 'Admin/CMS_Management/update_cms';



/* API Routes */
$route['admin/generate-token'] 							= 'API/Native_API_Controller/generate_token_api';
$route['admin/user-registration'] 						= 'API/Native_API_Controller/user_registration_api';
$route['admin/user-otp-verification'] 					= 'API/Native_API_Controller/user_otp_verification';
$route['admin/resend-user-otp'] 						= 'API/Native_API_Controller/resend_user_otp';
$route['admin/user-category-list'] 						= 'API/Native_API_Controller/user_category_list_api';
$route['admin/country-list'] 							= 'API/Native_API_Controller/country_list_api';
$route['admin/state-list'] 								= 'API/Native_API_Controller/country_wise_state_list_api';
$route['admin/city-list'] 								= 'API/Native_API_Controller/state_wise_city_list_api';
$route['admin/login-api'] 								= 'API/Native_API_Controller/login_api';
$route['admin/login-otp-verification'] 					= 'API/Native_API_Controller/user_otp_verification_for_login';
$route['admin/google-login'] 							= 'API/Native_API_Controller/login_with_google';
$route['admin/facebook-login'] 							= 'API/Native_API_Controller/login_with_facebook';
$route['admin/apple-login'] 							= 'API/Native_API_Controller/login_with_apple';
$route['admin/user-list'] 								= 'API/Native_API_Controller/user_list_api';
$route['admin/service-category-list'] 					= 'API/Native_API_Controller/service_category_list_api';
$route['admin/category-wise-service-list'] 				= 'API/Native_API_Controller/category_wise_service_list_api';
$route['admin/home-api'] 								= 'API/Native_API_Controller/home_api';
$route['admin/add-enquiry'] 							= 'API/Native_API_Controller/add_enquiry_api';
$route['admin/enquiry-list'] 							= 'API/Native_API_Controller/enquiry_list_api';
$route['admin/enquiry-details'] 						= 'API/Native_API_Controller/enquiry_details_api';
$route['admin/user-details'] 							= 'API/Native_API_Controller/user_details_api';
$route['admin/add-comments'] 							= 'API/Native_API_Controller/add_comments_api';
$route['admin/my-profile'] 								= 'API/Native_API_Controller/my_profile_api';
$route['admin/update-profile'] 							= 'API/Native_API_Controller/update_profile_api';
$route['admin/service-details'] 						= 'API/Native_API_Controller/service_details_api';
$route['admin/purchase-service'] 						= 'API/Native_API_Controller/purchase_service_api';
$route['admin/service-booking-list'] 					= 'API/Native_API_Controller/service_booking_list_api';
$route['admin/package-list-api'] 						= 'API/Native_API_Controller/package_list_api';
$route['admin/purchase-subscription'] 					= 'API/Native_API_Controller/purchase_subscription_api';
$route['admin/my-subscription'] 						= 'API/Native_API_Controller/my_subscribtion_api';
$route['admin/logout'] 									= 'API/Native_API_Controller/logout_api';
	
