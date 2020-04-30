<?php

namespace {

    use SilverStripe\CMS\Controllers\ContentController;
    use SilverStripe\Control\Director;

    class PageController extends ContentController
    {
        /**
         * An array of actions that can be accessed via a request. Each array element should be an action name, and the
         * permissions or conditions required to allow the user to access it.
         *
         * <code>
         * [
         *     'action', // anyone can access this action
         *     'action' => true, // same as above
         *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
         *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
         * ];
         * </code>
         *
         * @var array
         */
        private static $allowed_actions = [];

        protected function init()
        {
            parent::init();
             //$x = Query::get();
             //$y = Koneksi::get();
            //  $myclass='Koneksi';
            //  $myObject = new $myclass();
            //  $data = $myObject::get();
            // $y = Koneksi::create();
            // $x->fieldLabels(false);
            // $y->getComponents("Query");
            // $y->hasOne();
            //$x->offsetGet(1);
            // var_dump($data);
            //  die;

            
            $baseUrl= Director::absoluteBaseURL();
            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $is = in_array("app",$uri_segments);
            $isAdmin = in_array("admin",$uri_segments)||in_array("Security",$uri_segments)||in_array("api",$uri_segments);
            //  var_dump($is);
            // die;
            if ($is) {
                $home = file_get_contents($baseUrl."app");
                echo $home;
                die;
            } 
            if (!$isAdmin ) {
                $this->redirect(Director::absoluteBaseURL() . "app");
            }
            
            //  var_dump($is);
            // die;
            
            // You can include any CSS or JS required by your project here.
            // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
        }
    }
}
