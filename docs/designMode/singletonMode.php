<?php
/*
 * singleton design mode description/单例设计模式说明
 * @author HollenMok
 * @date 2015/08/02
 *
 * /
//pf 中数据库操作实例化使用了单例设计模式(singleton design mode)
/
 * 
 * 
 * 单例singleton 虽然有一个single在但不是指单身，更准确的应该是一夫一妻制。也就是如果你是男的，怎么保证你只有一个老婆，虽然有时候并不想这样，但很多情况必须这样
 * 例如数据库的连接。如果只需一个数据库连接那么只需要创建一个数据库连接对象。
 * 
 * 怎么实现保证只创建一次数据库连接对象呢，可以考虑使用全局变量作为标记，连接成功了就标记为已连接。但问题是其实程序代码都可以改变这个全局变量，如多线程，这个全局变量标记
 * 就会失效。还有一种解决方法就是数据库连接类内部设置一个私有的静态变量，用来标记是否已创建对象。这就是singleton模式。
 * 
 * 
 * 举例如下
 * 
 */
class singleton{
	//私有静态成员变量标记是否已创建实例,并保存唯一的实例
	private static $_instance = null;
	//私有构造函数不被外部访问
	private function __construct(){
		
	}
	//公共静态方法可用来创建 实例，并借助私有静态成员变量标记来保证且保存唯一实例
	public static function getInstance(){
		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance; 
	}
}


