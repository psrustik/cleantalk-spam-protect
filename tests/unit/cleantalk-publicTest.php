<?php
namespace test;
use \Mockery as m;
use WP_UnitTestCase;
use WPDieException;

class PublicTest extends WP_UnitTestCase
{

    public function testct_set_not_approved()
    {
        $this->assertEquals(0, ct_set_not_approved());
    }

    /**
     * @expectedException WPDieException
     */
    public function testct_die()
    {
        ct_die(123, 'status');
    }

    public function testct_preprocess_comment()
    {
        $comment = [
            'comment_post_ID' => 123,
            'comment_author' => 'guest',
            'comment_author_email' => 'example@example.com',
            'comment_author_url' => '',
            'comment_content' => 'The text of the proposed comment',
            'comment_type' => '',
            'user_ID' => '',
        ];
        $this->assertInternalType('array', ct_preprocess_comment($comment));
    }

    public function testjs_test()
    {
        $this->assertEquals(0, js_test());
        $this->assertEquals(0, js_test('ct_checkjs', array('ct_checkjs'=>'123')));
    }

    public function testjs_testByCookies()
    {
        global $ct_data;
        $ct_data['js_keys']=['my_js_key'=>'213'];
        $_COOKIE['ct_checkjs']= 'my_js_key';
        $this->assertEquals(1, js_test('ct_checkjs', $_COOKIE, true));

        $_COOKIE['ct_checkjs']= 'bad_key';
        $this->assertEquals(0, js_test('ct_checkjs', $_COOKIE, true));
    }
}