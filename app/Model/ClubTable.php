<?php

class ClubTable extends AppModel {

    var $name = 'ClubTable';
    var $displayField = 'table_name';
    var $validate = array(
        'user_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'club_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'table_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'category_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'minimum_price' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'table_min_guy' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'table_min_girls' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Club' => array(
            'className' => 'Club',
            'foreignKey' => 'club_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    var $hasMany = array(
        'Booking' => array(
            'className' => 'Booking',
            'foreignKey' => 'club_table_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Deal' => array(
            'className' => 'Deal',
            'foreignKey' => 'club_table_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function tabletype($club_id='') {
        if(empty($club_id))// i dont know whether you have used club or not
        $sql = "SELECT c.id,c.category_name,c.category_descriptions,totalT FROM `categories` AS c LEFT JOIN (SELECT COUNT(id) AS totalT,category_id FROM club_tables AS t GROUP BY category_id) AS x ON (x.category_id = c.id) WHERE c.category_type='table' AND c.status = 'active' HAVING totalT > 0 order by c.id desc";
        else 
       $sql="SELECT c.id,c.category_name,c.category_descriptions,totalT 
FROM `categories` AS c LEFT JOIN 
(SELECT COUNT(id) AS totalT,category_id FROM club_tables AS t WHERE t.`club_id`=".$club_id." GROUP BY category_id) 
AS X ON (X.category_id = c.id) WHERE c.category_type='table' AND c.status = 'active' HAVING totalT > 0 ORDER BY c.id DESC";
        
    
       
        $listings = $this->query($sql);
        
        return $listings;
    }
//final Update
    public function tablebookings($cat_id, $club_id, $arraival_date) {
       // $sql = "SELECT totalT FROM club_tables AS c LEFT JOIN (SELECT COUNT(id) AS totalT,club_table_id,arrival_date FROM bookings AS t GROUP BY club_table_id) AS b ON (b.club_table_id = c.id AND b.arrival_date='" . $arraival_date . "') WHERE c.club_id=" . $club_id . " AND c.category_id=" . $cat_id . " HAVING totalT > 0";
       $sql="SELECT COUNT(id) total,arrival_date FROM bookings  WHERE  bookings.status<>'cancelled' AND bookings.status<>'club_closed' and bookings.`arrival_date`='" . $arraival_date . "'  AND club_table_id IN(SELECT  id FROM club_tables WHERE  club_tables.`club_id`=".$club_id." AND  club_tables.`category_id`=".$cat_id.")";
         //echo  $sql = "SELECT count(id) total  ,id,category_id,club_id total from club_tables WHERE category_id = $cat_id AND club_id =  $club_id AND id NOT IN (SELECT club_table_id FROM bookings WHERE arrival_date = '".$arraival_date."')";
        //$sql="SELECT COUNT(id) total ,id ,category_id,club_id  
          //FROM club_tables WHERE category_id = $cat_id AND club_id = $club_id AND 
          //id NOT IN (SELECT club_table_id FROM bookings WHERE arrival_date = '" . $arraival_date . "') HAVING total>0 ";
         
        $bookings = $this->query($sql);
        
        if(isset($bookings[0][0]['total']))
        return ($bookings[0][0]['total']);
        
    }

    public function select_table_for_booking($cat_id, $club_id, $arraival_date) {
       //$sql="SELECT club_table_id FROM bookings WHERE arrival_date = '".$arraival_date."'";
       
        $sql = "SELECT * FROM club_tables WHERE category_id = $cat_id AND club_id =  $club_id AND id NOT IN "
               . "(SELECT club_table_id FROM bookings WHERE status<>'cancelled' AND status<>'club_closed' and arrival_date = '".$arraival_date."') Order By minimum_price DESC  LIMIT 1";
       
       $bookings = $this->query($sql);
       
        if (isset($bookings[0]['club_tables']['id']))
        return $bookings[0]['club_tables']['id'];
        else return false;
        
    }

}

?>