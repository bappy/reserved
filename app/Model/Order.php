<?php

class Order extends AppModel {

    var $name = 'Order';
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
        'booking_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
//'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'club_table_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
//'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'quantity' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            //'message' => 'Your custom message here',
//'allowEmpty' => false,
//'required' => false,
//'last' => false, // Stop validation after this rule
//'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'price' => array(
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
    var $hasMany = array(
        'OrderItem' => array(
            'className' => 'OrderItem',
            'foreignKey' => 'order_id',
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
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UserP' => array(
            'className' => 'User',
            'foreignKey' => 'promoter_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'UserInfo' => array(
            'className' => 'UserInfo',
            'foreignKey' => 'promoter_id',
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
        'Booking' => array(
            'className' => 'Booking',
            'foreignKey' => 'booking_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ClubTable' => array(
            'className' => 'ClubTable',
            'foreignKey' => 'club_table_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function total_order($club_id, $firstDay, $lastDay = null) {
        $this->recursive = -1;
        //$this->loadModel('OrderItem');
        if ($lastDay)
            $conditions = array('Order.status' => 'completed', 'Order.club_id' => $club_id, 'Order.order_date >=' => $firstDay, 'Order.order_date <=' => $lastDay);
        else
            $conditions = array('Order.status' => 'completed', 'Order.club_id' => $club_id, 'Order.order_date ' => $firstDay);

        $data_earnings = $this->find('all', array(
            'fields' => array("order_date"),
            'conditions' => $conditions,
            'group' => array('order_date')
                )
        );

        if (isset($data_earnings)) {
            foreach ($data_earnings as $key => $row) {
                $this->recursive = -1;
                $orders = $this->find('list', array(
                    'fields' => array("Order.id"),
                    'conditions' => array('Order.status' => 'completed', 'Order.club_id' => $club_id, 'Order.order_date' => $row['Order']['order_date'])
                        )
                );

                $order_items = $this->OrderItem->find('all', array(
                    'fields' => array('SUM(OrderItem.price*OrderItem.quantity) totalprice'),
                    'conditions' => array('OrderItem.order_id' => $orders)
                        )
                );
                $data_earnings[$key]['Order']['price'] = $order_items[0][0]['totalprice'];
            }
        }
        return $data_earnings;
    }

    public function promoter_total_order($order_lists, $firstDay, $lastDay = null) {
        $this->recursive = -1;
        
        if ($lastDay)
            $conditions = array('Order.status' => 'completed', 'Order.id' => $order_lists, 'Order.order_date >=' => $firstDay, 'Order.order_date <=' => $lastDay);
        else
            $conditions = array('Order.status' => 'completed', 'Order.id' => $order_lists, 'Order.order_date ' => $firstDay);

        $data_earnings = $this->find('all', array(
            'fields' => array("order_date"),
            'conditions' => $conditions,
            'group' => array('order_date'),
            'order' => array('order_date desc')
                )
        );

        if (isset($data_earnings)) {
            foreach ($data_earnings as $key => $row) {
                $this->recursive = -1;
                $orders = $this->find('list', array(
                    'fields' => array("Order.id"),
                    'conditions' => array('Order.status' => 'completed', 'Order.id' => $order_lists, 'Order.order_date' => $row['Order']['order_date'])
                        )
                );

                $order_items = $this->OrderItem->find('all', array(
                    'fields' => array('SUM(OrderItem.price*OrderItem.quantity) totalprice'),
                    'conditions' => array('OrderItem.order_id' => $orders)
                        )
                );
                $data_earnings[$key]['Order']['price'] = $order_items[0][0]['totalprice'];
            }
        }
        return $data_earnings;
    }

    public function master_promoter_total_order($id = null) {
        $this->recursive = -1;
        if(isset($id) & $id > 0)
        $conditions = array('Order.status' => 'completed', 'Order.promoter_id' => $id);
        else
        $conditions = array('Order.status' => 'completed', 'Order.promoter_id >' => 0);


        $orders = $this->find('list', array(
            'fields' => array("Order.id"),
            'conditions' => $conditions
        ));
        
        return $this->OrderItem->find('all', array(
            'fields' => array('SUM(OrderItem.price*OrderItem.quantity) totalprice'),
            'conditions' => array('OrderItem.order_id' => $orders)
        ));
    }
    
    public function master_user_total_order($id = null) {
        $this->recursive = -1;
        if(isset($id) & $id > 0)
        $conditions = array('Order.status' => 'completed', 'Order.user_id' => $id);
        else
        $conditions = array('Order.status' => 'completed', 'Order.user_id >' => 0);


        $orders = $this->find('list', array(
            'fields' => array("Order.id"),
            'conditions' => $conditions
        ));
        
        return $this->OrderItem->find('all', array(
            'fields' => array('SUM(OrderItem.price*OrderItem.quantity) totalprice'),
            'conditions' => array('OrderItem.order_id' => $orders)
        ));
    }

    public function user_order_detail($club_id, $date) {
        $this->Behaviors->load('Containable');
        $contain = array(
            'OrderItem' => array(
                'ClubBottle' => array(
                    'fields' => array('category_id', 'bottle_name'),
                    'Category' => array('category_name')
                )
            ),
            'User' => array(
                'fields' => array('id', 'name')
            )
        );

        $return_data = $this->find("all", array(
            'contain' => $contain,
            'conditions' => array('Order.status' => 'completed', 'Order.club_id' => $club_id, 'Order.order_date' => $date),
            'order' => array('Order.order_time' => 'DESC')
                )
        );
        return $return_data;
    }

    public function promoter_user_order_detail($order_lists, $firstDay, $lastDay = null) {
        $data_earnings = $this->promoter_total_order($order_lists, $firstDay, $lastDay);

        if (isset($data_earnings)) {
            foreach ($data_earnings as $key => $row) {
                $this->recursive = -1;
                $orders = $this->find('list', array(
                    'fields' => array("Order.id"),
                    'conditions' => array('Order.status' => 'completed', 'Order.id' => $order_lists, 'Order.order_date' => $row['Order']['order_date'])
                        )
                );

                $this->Behaviors->load('Containable');
                $contain = array(
                    'OrderItem' => array('fields' => array('(OrderItem.price*OrderItem.quantity) totalprice')),
                    'User' => array(
                        'fields' => array('id', 'name')
                    ),
                    'Club' => array(
                        'fields' => array('id', 'club_name')
                    )
                );

                $data_earnings[$key]['order_items'] = $this->find("all", array(
                    'contain' => $contain,
                    'conditions' => array('Order.status' => 'completed', 'Order.id' => $orders),
                    'order' => array('Order.order_time' => 'DESC')
                        )
                );
            }
        }


        return $data_earnings;
    }

    public function promoter_weekly_order_detail($order_lists, $firstDay, $lastDay) {
        $this->Behaviors->load('Containable');
        $contain = array(
            'OrderItem' => array('fields' => array('(OrderItem.price*OrderItem.quantity) totalprice'))
        );

        $total_orders = $this->find("all", array(
            'contain' => $contain,
            'fields' => array('Order.order_date'),
            'conditions' => array('Order.status' => 'completed', 'Order.id' => $order_lists, 'Order.order_date BETWEEN ? and ?' => array($firstDay, $lastDay))
                )
        );
        $total_price = 0;

        foreach ($total_orders as $order) {
            $price = 0;
            foreach ($order['OrderItem'] as $data) {
                $price+=$data['OrderItem'][0]['totalprice'];
            }
            $total_price+= $price;
        }
        return $total_price;
    }

    public function weekly_data($order_lists, $firstDay, $lastDay) {
        return $this->find("all", array(
                    "fields" => array("count(*) as tclients", "str_to_date(concat(yearweek(order_date), 'saturday'), '%X%V %W') as `date`"),
                    "conditions" => array('Order.status' => 'completed', 'Order.id' => $order_lists, 'Order.order_date BETWEEN ? and ?' => array($firstDay, $lastDay)),
                    "group" => array("yearweek(order_date)")
        ));
    }

    function rangeWeek($datestr) {
        date_default_timezone_set(date_default_timezone_get());
        $dt = strtotime($datestr);
        $res['start'] = date('N', $dt) == 0 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last sunday', $dt));
        $res['end'] = date('N', $dt) == 6 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next saturday', $dt));
        return $res;
    }

    function rangeMonth($datestr) {
        date_default_timezone_set(date_default_timezone_get());
        $dt = strtotime($datestr);
        $res['start'] = date('Y-m-d', strtotime('first day of this month', $dt));
        $res['end'] = date('Y-m-d', strtotime('last day of this month', $dt));
        return $res;
    }

    function getStartAndEndDate($week, $year) {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['start'] = $dto->format('Y-m-d');
        $dto->modify('+6 days');
        $ret['end'] = $dto->format('Y-m-d');
        return $ret;
    }
	
	function admin_details_order($order_lists,$date){
		//$this->unbindModel(array("belongsTo" => array("UserInfo", "Booking", "ClubTable")));
        $contain = array(
            'OrderItem' => array(
                'fields' => array('OrderItem.id', 'OrderItem.order_id', 'OrderItem.club_bottle_id', 'OrderItem.quantity', '(OrderItem.price*OrderItem.quantity) totalprice'),
                'ClubBottle' => array(
                    'fields' => array('ClubBottle.bottle_name')
                )
            ),
            'User' => array(
                'fields' => array('User.id')
            ),
            'UserP' => array(
                'fields' => array('UserP.Promoter_code')
            ),
            'Club' => array(
                'fields' => array('club_name')
            )
        );

        $this->Behaviors->load('Containable', array('recursive' => true));
        $conditions = array("Order.id" => $order_lists, 'Order.order_date >=' => $date['start'], 'Order.order_date <=' => $date['end']);
        $order = array('Order.order_time DESC');
        $details = $this->find('all', array('conditions' => $conditions, 'order' => $order, 'contain' => $contain));
		return $details;
		}
		
	function admin_details_order_day($order_lists,$date){
		//$this->unbindModel(array("belongsTo" => array("UserInfo", "Booking", "ClubTable")));
        $contain = array(
            'OrderItem' => array(
                'fields' => array('OrderItem.id', 'OrderItem.order_id', 'OrderItem.club_bottle_id', 'OrderItem.quantity', '(OrderItem.price*OrderItem.quantity) totalprice'),
                'ClubBottle' => array(
                    'fields' => array('ClubBottle.bottle_name')
                )
            ),
            'User' => array(
                'fields' => array('User.id')
            ),
            'UserP' => array(
                'fields' => array('UserP.Promoter_code')
            ),
            'Club' => array(
                'fields' => array('club_name')
            )
        );

        $this->Behaviors->load('Containable', array('recursive' => true));
        $conditions = array("Order.id" => $order_lists, 'Order.order_date' => $date);
        $order = array('Order.order_time DESC');
        $details = $this->find('all', array('conditions' => $conditions, 'order' => $order, 'contain' => $contain));
		return $details;
		}
}

?>