<?php
 class  Db{
    	/**
	 * 数据库配置
	 * $host    主机
	 * $user    用户名
	 * $passwd  密码
	 * $conn    数据库链接
	 */
    private static $instance;
    private $conn;
	private $host = 'localhost';
	private $user = 'root';
	private $passwd = '';
	private $dbname = 'teach_nndou';
    private function __construct($host= 'localhost',$user= 'root',$passwd= '',$dbname= 'teach_nndou'){
        $this->host = $host;
        $this->user = $user;
        $this->password = $passwd;
        $this->dbname = $dbname;
        $this->db_connct($this->host,$this->user,$this->password,$this->dbname);
    }


    private function __clone(){}
    

    private function __desctruct(){}

    public function getConn(){
        return $this->conn;
    }
    public static function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self($host= 'localhost',$user= 'root',$passwd= '',$dbname= 'teach_nndou');
        }
        return  self::$instance;
    }

	//连接数据库函数
	function db_connct($host,$user,$passwd,$dbname){
		$this->conn = mysqli_connect($host,$user,$passwd,$dbname);

		if(!$this->conn){
			die('数据库连接失败!<br />'.mysqli_connect_error());
		}

		mysqli_set_charset($this->conn,'utf8');
    }


    	/**
	 * 查询多条记录 select_all()
	 * @param $table
	 * @return array
	 */
	function select_all($table,$ele='*',$condition=''){
		$sql = "SELECT $ele FROM nnd_{$table} {$condition}";
		$info = mysqli_query($this->conn,$sql);
		while ($res = mysqli_fetch_array($info)){
			$res_arr[] = $res;
		}
		return isset($res_arr) ? $res_arr : '无记录!';
	}

    
    	/**
	 * 查询一条记录
	 * @param $table                表名
	 * @param string $condition     条件语句
	 * @return array|null           结果集
	 */
	function select_one($table,$ele='*',$condition=''){
		$sql = "SELECT $ele FROM nnd_{$table} {$condition}";
		$res = mysqli_query($this->conn,$sql);
		return mysqli_fetch_array($res);
    }
    
    	/**
	 * 连表查询一条记录
	 * @param $table                表名
	 * @param string $condition     条件语句
	 * @return array|null           结果集
	 */
	function union_select_one($table1,$table2,$condition=''){
		$sql = "SELECT * FROM nnd_{$table1},nnd_{$table2} {$condition}";
		$res = mysqli_query($this->conn,$sql);
		return mysqli_fetch_array($res);
    }
    



    /**
	 * 自由查询多条记录 select_all()
	 * @param $table
	 * @return array
	 */
	function feel_select_all($sql){
		$info = mysqli_query($this->conn,$sql);
		while ($res = mysqli_fetch_array($info)){
			$res_arr[] = $res;
		}
		return isset($res_arr) ? $res_arr : '无记录!';
	}

	/**
	 * 自由查询一个字段
	 * @param $table                表名
	 * @param string $condition     条件语句
	 * @return array|null           结果集
	 */
	function feel_select_one($sql){
		$res = mysqli_query($this->conn,$sql);
		return mysqli_fetch_array($res)[0];
	}


	/**
	 * 自由查询一条记录
	 * @param $table                表名
	 * @param string $condition     条件语句
	 * @return array|null           结果集
	 */
	function feel_select_ones($sql){
		$res = mysqli_query($this->conn,$sql);
		return mysqli_fetch_array($res);
	}


	//删除记录
	function del($sql){
		return mysqli_query($this->conn,$sql);
	}
	//添加信息
	function insert($table,$arr){
        $keys = '';
        $values = '';
        foreach($arr as $k => $v){
            $keys .= $k.',';
            $values .= "'$v'".',';
        }
        $keys = rtrim($keys,',');
        $values = rtrim($values,',');
		$sql = "insert into nnd_{$table}($keys) values($values)";
		// echo $sql;
        $res = mysqli_query($this->conn,$sql);
        return $res;
	}
	

	//删除记录
	function dele($sql){
		$res = mysqli_query($this->conn,$sql);
		return $res;
	}


	//更改信息
	function update2($table,$arr,$condition){
        $u_str = '';
        foreach($arr as $k => $v){
            $u_str .= "{$k} = '$v',";
        }
        $u_str = rtrim($u_str,',');
		$sql = "update nnd_{$table} set $u_str $condition";
		// echo $sql;die;
        $res = mysqli_query($this->conn,$sql);
        return $res;
	}
	

	//更改信息
	function update($arr,$id){
        $u_str = '';
        foreach($arr as $k => $v){
            $u_str .= "{$k} = '$v',";
        }
        $u_str = rtrim($u_str,',');
		$sql = "update nnd_info set $u_str where info_id = $id";
		
        $res = mysqli_query($this->conn,$sql);
        return $res;
    }


}