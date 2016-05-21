<?php
/*
 * -----------------------------
* module of product component
* 产品组件模块
* -----------------------------
* @author HollenMok
* @date 2015/09/25
*
*/
class productModuleProduct{
	
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/product/product.php';
		$this->productQuery = new productDbqueryProduct();
	}
	public function display(){
		$products_id = $_GET['products_id'];
		$productInfo['description'] = $this->productQuery->getDescription($products_id);
	    $sizeData = $this->sizeAnalysis($productInfo['description']);
	    $productInfo['sizeTable'] = $sizeData['inches'];
	    $productInfo['sizeHead'] = $sizeData['sizeHead'];
	    $productInfo['centimeters'] = $sizeData['centimeters'];
	    $productInfo['sizeText'] = $sizeData['sizeText'];
	    $productInfo['description'] = $this->splitDescription($productInfo['description']);
	    $generalInfo = $this->productQuery->getGeneralInfo($products_id);
	    $productInfo['products_name'] = $generalInfo[0]['products_name'];
	    $productInfo['images_path'] = $this->getImagesPath($products_id);
	    $productInfo['firstImage'] = $productInfo['images_path'][0];
		return $productInfo;
	}
	public function splitDescription($description){
		$pattern = '/<ul[\w\s\S<>]+ul>/';
		preg_match($pattern,$description,$m);
		return $m[0];
	}
	public function sizeAnalysis($description){
		 
		$pattern = '/<div id=\'specification\'>([^<]+)<\/div><div id=\'specification_end\'><\/div>/i';
		$result = $sizeHead = $centimeters = array();
		
		if (preg_match($pattern, $description, $m)){
			
			$m[1] = str_ireplace('	','',$m[1]);
			$data = json_decode(trim($m[1]));
			$data = (array)$data;
			$result = $data['data'];
			
			$sizeHead = (isset($data['title']) && $data['title']) ? $data['title'] : $this->getSizeChartHead('3608');
			
			foreach($result as $k=>$v){
				foreach($v as $kk=>$vv){
					$vv = trim($vv);
					if(empty($vv)){
						if(isset($sizeHead)) unset($sizeHead[$kk]);
						unset($result[$k][$kk]);
					}
				}
			}
			
			foreach($result as $k=>$v){
				foreach($v as $kk=>$vv){
					$vv = trim($vv);
					if($kk == 0){
						$centimeters[$k][$kk] = $vv;
						continue;
					}
					if(strcasecmp($vv,'Free')==0){
						$centimeters[$k][$kk] = $vv;
						continue;
					}
					$matchStr = '';
					if(preg_match('/([^\d]+) ([\d.]+)/i',$vv,$match)){
						$matchStr = $match[1].' ';
						$vv = $match[2];
					}
					$i = explode('-',$vv);
					$vvv = array();
					foreach($i as $ii){
						$ii = trim($ii)*2.54;
						$ii = round($ii,2);
						$vvv[] = $ii;
					}
					$newStr = implode('-',$vvv);
					$centimeters[$k][$kk] = $matchStr.$newStr;
				}
			}
			
			foreach($sizeHead as $k=>$v){	
				$v = strtoupper(str_replace(' ','_',$v));
				$sizeHead[$k] = $v;
			}
			$sizeText = array();
			
			foreach($result as $data){
				$sizeName = preg_replace('/\(.*\)/i','',$data[0]);
				$sizeName = trim($sizeName);
				unset($data[0]);
				ksort($data);
				$sizeData = '';
				foreach($data as $key=>$size){
					$string = intval($size) > 0 ? $size.' Inch' : $size;
					$sizeData .= $sizeData ? ','.$sizeHead[$key].":".$string : $sizeHead[$key].":".$string;
				}
				$sizeText[$sizeName] = $sizeData;
			}
			
			$sizeTable['sizeHead'] = $sizeHead;
			$sizeTable['inches'] = $result;
			$sizeTable['centimeters'] = $centimeters;
			$sizeTable['sizeText'] = $sizeText;
			
			return $sizeTable;
		}
	}
	
	public function getSizeChartHead($cat_id){
		
		$sizeHead = '';
		$sizeCat = array(
				3608=>array('cat'=>array(3608),'head'=>array('Size','Bust','Shoulder','Waist','Length','Sleeve Leng')),
				3603=>array('cat'=>array(3603),'head'=>array('Size','Bust','Shoulder','Waist','Length','Sleeve Leng')),
				3683=>array('cat'=>array(3683),'head'=>array('Size','Waist','Length','Hem')),
				3604=>array('cat'=>array(3604),'head'=>array('Size','Bust','Shoulder','Length','Sleeve Leng')),
				3702=>array('cat'=>array(3702),'head'=>array('Size','Bust','Shoulder','Waist','Length','Sleeve Leng','Hip','Height')),
				3671=>array('cat'=>array(3671,3672,3674,3681,3682),'head'=>array('Size','Waist','Hip','Front Rise','Length','Thigh')),
				3582=>array('cat'=>array(3582,3588,3586),'head'=>array('Size','Bust','Shoulder','Length','Sleeve Leng')),
				3583=>array('cat'=>array(3583,3584,3585),'head'=>array('Size','Bust','Shoulder','Length','Sleeve Leng')),
				3587=>array('cat'=>array(3587,3589),'head'=>array('Size','Waist','Hip','Front Rise','Thigh','Leng')),
		);
		$cat_path = array('0'=>3608);
		foreach($sizeCat as $key=>$row){
			if(array_intersect($row['cat'],$cat_path)){
				$sizeHead = $sizeCat[$key]['head'];
				break;
			}
		}
		return $sizeHead;
	}
	/*
	 * @author mohuahuan 
	 * @date 2016/05/21
	 * @desc 根据产品id获取产品属性
	 */
	public function getAttributes($products_id){
	    $attributes = $this->productQuery->getAttributes($products_id);
	    //整理后的属性数据
	    $attributes_arr = array();
	    $image_dir = "/applications/pandoraf/templates/imgServer";
	    foreach($attributes as $k =>$v){
	            $attributes_arr[$v["options_id"]]['name'] =  $v['products_options_name']; 
	            $attributes_arr[$v["options_id"]]['values'][$v['options_values_id']]['value_name'] =  $v['products_options_values_name'];
	            //颜色属性才显示图片
	            if($v["options_id"] == '379'){
	                $attributes_arr[$v["options_id"]]['values'][$v['options_values_id']]['smallImage'] =  $image_dir.$v['image_path'];
	            }	           
	    }
	    return $attributes_arr;
	}
	/*
	 * @desc 获取产品图片路径信息
	 * @author mohuahuan
	 * @date 2016/05/21
	 */
	public function getImagesPath($products_id){
	    //获取对应图片服务器文件夹图片名
	    $image_dir = ROOT."/applications/pandoraf/templates/imgServer";
	    $imageServer_path =  $image_dir."/p".$products_id."/large";
	    $filenames = scandir($imageServer_path);
	    array_shift($filenames);
	    array_shift($filenames);
	    return $filenames;
	}
}
	


