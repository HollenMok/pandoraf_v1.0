<?php
/*
 * factory design mode description/工厂设计模式说明
 * @author HollenMok
 * @date 2015/08/02
 * 
 * /
//pf 中数据库操作实例化使用了工厂设计模式（factory design mode）
//
 * 
 * 软件设计中总是想尽办法来降低程序间的耦合性（程序间相关性越小越好，如MVC设计模式使用模型层与界面层与控制器层分离，于是界面设计人员与程序员可以分工互不影响，利于合作提高效率）
 * 可以肯定的是耦合性越小越好，其实面向对象编程思想是从一开始就开始了降低耦合性的工作。按一个对象一个对象来编程序，本来就最大降低了耦合性。
 * 
 * 工厂模式其实是在整合对象中的共同部分，让对象变得更小更独立。
 * 
 * 
 * 这其实来源于现实生活中工厂模式
 * 
 * 个体农业时代：要想拥有一辆汽车，你得自己一个人造。制造车轮，制造模具，制造发动机，整装车。自己造自己卖自己买，也就是自给自足。
 * 个体手工业时代：你把制造的多出的车卖给别人，你成了供应商，可以靠卖车赚钱了。但由于客户越来越多，你供应能力不足。于是开始想请人来做。
 * 工厂手工业时代： 招到一推人作为师傅你教他们每人分别学会一个技能，于是制造车轮，制造模具，制造发动机，整装车都有一个人负责。采用流水线方法很快生产效率上升了很多。
 * 之前一直生产很普通的车，现在名气大了，奔驰设计公司要你们生产一万辆奔驰车，完成这个订单就成百万富翁了，但现在生产能力不够怎么办。
 * 工厂机器业时代：幸好工业革命来临了，于是你马上采购了几台机器，制造车轮机器，制造模具机器，制造发动机机器，整装车机器，于是生产效率提高了上百倍，终于成了百万富翁。
 * 完成了奔驰公司的订单，这时宝马公司的找上门要求生产十万辆宝马，十万辆订单呐，这么多钱肯定要赚，可是麻烦来了，现在奔驰也是稳定客户，当时采购的机器，招的人，生产的标准都是按奔驰来搞的。
 * 第二次工业革命：于是必须开两条生产线，一条为宝马的一条为奔驰的这样才不会乱呐。而且开始生产一些既适合宝马也适合奔驰的标准配件。比如车轮等。
 * 第三次工业革命：革命带来了不同技术的融合，有些宝马是电力驱动的等，产生了很多不同的宝马系列，奔驰也是。于是工厂不再只是搞汽车的工厂了，还得搞电池研发，微电子技术等。
 * 于是某一天特斯拉公司要求生产一百万台特斯拉电动跑车你就可以轻松的供应了，此时你已是亿万富翁。
 * 
 * 
 * 上面的历史也是编程中的工厂模式遇到的情况。
 * 
 * 查了一下资料发现设计模式已被当作学术研究一样研究了，科研人员们总能想办法把所有的复杂情况进行分类与归纳总结。
 * 
 * 
 * 
 * 工厂模式一般使用在创建对象上面，一般简单的类new一下就出来了，但像与数据库操作相关的查询类，要new之前必须要进行数据库操作类的创建，缓存类的创建，配置文件类创建等，过程比较多比较复杂，
 * 因为查询类会有很多，每一个查询类创建前都要先创建很多别的类，这就造成了操作冗余。于是可以将这些过程中用到的类都放到一个工厂里面处理，以后就可以只创建一个工厂类了。
 * 
 * 
 * 用到工厂模式的情况从简单到复杂一般有三类：
 * 没有工厂模式：假如还没有工业革命，如果一个客户要一款宝马车,一般的做法是客户去创建一款宝马车，然后拿来用。
 * a.简单工厂模式（simple factory）：后来出现工业革命。用户不用去创建宝马车。因为客户有一个工厂来帮他创建宝马.想要什么车，这个工厂就可以建。比如想要320i系列车。工厂就创建这个系列的车。即工厂可以创建产品。
 * b.工厂方法模式(factory method)：为了满足客户，宝马车系列越来越多，如320i，523i,30li等系列一个工厂无法创建所有的宝马系列。于是由单独分出来多个具体的工厂。每个具体工厂创建一种系列。即具体工厂类只能创建一个具体产品。但是宝马工厂还是个抽象。你需要指定某个具体的工厂才能生产车出来。
 * c.抽象工厂模式(abstract factory)：随着客户的要求越来越高，宝马车必须配置空调。而且这空调必须对应给系列车才能使用。于是这个工厂开始生产宝马车和需要的空调。
 * 
 * 
 * 下面是相应的代码示例：
 * 

 * 
 */
/*****************************************************/
//没有使用工厂模式时 
//宝马车系列类
class BMW320{
	function __construct(){
		
	}
}
class BMW523{
	function __construct(){

	}
}
//客户自己创建宝马车类
class customer {
	function createBMW320(){
		return new BMW320();
	}
	function createBMW523(){
		return new BMW523();
	}
}
/*******************************************************/
//简单工厂模式（simple factory）
//产品类
abstract class BMW{
	function __construct($pa){
		
	}
}
class BMW320 extends BMW{
	function __construct($pa){
		
	}
}
class BMW523 extends BMW{
	function __construct($pb){

	}
}
//工厂类
class factory{
	static function createBMW($type){
		switch($type){
			case 320:
				return new BMW320();
			case 523:
				return new BMW523();
		}
	}
}
//客户类
class customer{
	private $BMW; 
	function getBMW($type){
		$this->BMW = factory::createBMW($type);
	}
}
/*******************************************************/
//工厂方法模式（factory method）
//产品类
abstract class BMW{
	function __construct($pa){

	}
}
class BMW320 extends BMW{
	function __construct($pa){

	}
}
class BMW523 extends BMW{
	function __construct($pb){

	}
}
//工厂类
interface factoryBMW{
	function createBMW();
}
class factoryBMW320 implements factoryBMW{
	function createBMW($type){
		return new BMW320();
	}
}
class fcatoryBMW523 implements factoryBMW{
	function createBMW($type){
		return new BMW523();
	}
}
//客户类
class customer{
	private $BMW;
	function getBMW($type){
		switch($type){
			case 320:
				$BWM320 = new factoryBMW320();
				return $BWM320->createBMW();
			case 523:	
				$BWM523 = new factoryBMW523();
				return $BWM523->createBMW();
		}
	}
}
/*******************************************************/
//抽象工厂模式（abstract factory）
//产品类
abstract class BMW{
	
}
class BMW532 extends BMW{
	
}
class BMW320 extends BMW{
	
}

abstract class aircondition{

}
class airconditionBMW320 extends aircondition{
	
}
class airconditionBMW523 extends aircondition{

}
//工厂类
interface factoryBMW{
	function createBMW();
	function createAir();
}
class factoryBMW320 implements factoryBMW{
	function createBMW(){
		return new BMW320();
	}
	function createAir(){
		return new airconditionBMW320();
	}
}
class factoryBMW523 implements factoryBMW{
	function createBMW(){
		return new BMW523();
	}
	function createAir(){
		return new airconditionBMW523();
	}
}
//客户类
class customer{
	private $BMW;
	private $airC;
	function getBMW($type){
		switch($type){
			case 320:
				$BWM320 = new factoryBMW320();
				return $BWM320->createBMW();
			case 523:	
				$BWM523 = new factoryBMW523();
				return $BWM523->createBMW();
		}
	}
}
/*******************************************************/





















 
