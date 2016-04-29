<?php


class LOUVREGetPrice{

    public function testIsPrice()
    {
        $getPrice = new LOUVREGetPrice(
            $this->getMockBuilder('LOUVREGetPrice')->disableConstructorOriginal()->getMock(), // pour ignorer un constructeur
            $this->getMock('LOUVREChildPrice'),
            $this->getMock('LOUVRESeniorPrice')
        );

        // mocker chaque service et leurs attribuer une valeur et les utiliser dans chque cas de figure

        $this->assertTrue($getPrice->isPrice());
    }
}