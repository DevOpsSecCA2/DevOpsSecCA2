require "test_helper"

class TipsControllerTest < ActionDispatch::IntegrationTest
  test "should get index" do
    get tips_index_url
    assert_response :success
  end
end
