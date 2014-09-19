<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014
 */


namespace Aimeos\ShopBundle\Controller;


class CatalogController extends AbstractController
{
	public function countAction()
	{
		parent::init();

		$context = $this->getContext();
		$arcavias = $this->getArcavias();
		$templatePaths = $arcavias->getCustomPaths( 'client/html' );

		$count = \Client_Html_Catalog_Count_Factory::createClient( $context, $templatePaths );
		$count->setView( $this->createView() );
		$count->process();

		return $this->render( 'AimeosShopBundle:Catalog:xhr.html.twig', array( 'output' => $count->getBody() ) );
	}


	public function detailAction()
	{
		parent::init();

		$context = $this->getContext();
		$arcavias = $this->getArcavias();
		$templatePaths = $arcavias->getCustomPaths( 'client/html' );

		$minibasket = \Client_Html_Basket_Mini_Factory::createClient( $context, $templatePaths );
		$minibasket->setView( $this->createView() );
		$minibasket->process();

		$stage = \Client_Html_Catalog_Stage_Factory::createClient( $context, $templatePaths );
		$stage->setView( $this->createView() );
		$stage->process();

		$detail = \Client_Html_Catalog_Detail_Factory::createClient( $context, $templatePaths );
		$detail->setView( $this->createView() );
		$detail->process();

		$session = \Client_Html_Catalog_Session_Factory::createClient( $context, $templatePaths );
		$session->setView( $this->createView() );
		$session->process();

		$header = $minibasket->getHeader() . $session->getHeader() . $detail->getHeader() . $stage->getHeader();

		$parts = array(
			'header' => $header,
			'minibasket' => $minibasket->getBody(),
			'session' => $session->getBody(),
			'detail' => $detail->getBody(),
			'stage' => $stage->getBody(),
		);

		return $this->render( 'AimeosShopBundle:Catalog:detail.html.twig', $parts );
	}


	public function listsimpleAction()
	{
		parent::init();

		$context = $this->getContext();
		$arcavias = $this->getArcavias();
		$templatePaths = $arcavias->getCustomPaths( 'client/html' );

		$count = \Client_Html_Catalog_List_Factory::createClient( $context, $templatePaths, 'Simple' );
		$count->setView( $this->createView() );
		$count->process();

		return $this->render( 'AimeosShopBundle:Catalog:xhr.html.twig', array( 'output' => $count->getBody() ) );
	}


	public function listAction()
	{
		parent::init();

		$context = $this->getContext();
		$arcavias = $this->getArcavias();
		$templatePaths = $arcavias->getCustomPaths( 'client/html' );

		$minibasket = \Client_Html_Basket_Mini_Factory::createClient( $context, $templatePaths );
		$minibasket->setView( $this->createView() );
		$minibasket->process();

		$filter = \Client_Html_Catalog_Filter_Factory::createClient( $context, $templatePaths );
		$filter->setView( $this->createView() );
		$filter->process();

		$stage = \Client_Html_Catalog_Stage_Factory::createClient( $context, $templatePaths );
		$stage->setView( $this->createView() );
		$stage->process();

		$list = \Client_Html_Catalog_List_Factory::createClient( $context, $templatePaths );
		$list->setView( $this->createView() );
		$list->process();

		$header = $minibasket->getHeader() . $filter->getHeader() . $stage->getHeader() . $list->getHeader();

		$parts = array(
			'header' => $header,
			'minibasket' => $minibasket->getBody(),
			'filter' => $filter->getBody(),
			'stage' => $stage->getBody(),
			'list' => $list->getBody(),
		);

		return $this->render( 'AimeosShopBundle:Catalog:list.html.twig', $parts );
	}


	public function stockAction()
	{
		parent::init();

		$context = $this->getContext();
		$arcavias = $this->getArcavias();
		$templatePaths = $arcavias->getCustomPaths( 'client/html' );

		$stock = \Client_Html_Catalog_Stock_Factory::createClient( $context, $templatePaths );
		$stock->setView( $this->createView() );
		$stock->process();

		return $this->render( 'AimeosShopBundle:Catalog:xhr.html.twig', array( 'output' => $stock->getBody() ) );
	}
}