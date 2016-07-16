<?php

class Article_tag_model extends CI_Model

{



    function getArticleTagByArticle($articleId)

    {

        $this->db->select(  'tag, a.tagID as tagID,

                            replace(tag,\' \',\'-\') as tag_url_clean
                            
                            ');

        $this->db->from('tbl_cyberits_s_articles_tags a');

        $this->db->join('tbl_cyberits_m_tags b', 'a.tagID=b.tagID');

        $this->db->where('a.articleID', $articleId);

        $this->db->where('b.isActive', 1);

        $query = $this->db->get();

        return $query->result_array();

    }



    function getTagList($start, $limit)

    {

        $this->db->select('*');

        $this->db->from('tbl_cyberits_m_tags b');

        $this->db->where('b.isActive', 1);



        if ($limit != null || $start != null) {

            $this->db->limit($limit, $start);

        }



        $query = $this->db->get();

        return $query->result_array();

    }



    function getCountTagList()

    {

        $this->db->from('tbl_cyberits_m_tags a');

        return $this->db->count_all_results();

    }



    function createArticleTag($data_tag)

    {

        $this->db->insert('tbl_cyberits_s_articles_tags', $data_tag);

        $result = $this->db->affected_rows();

        return $result;

    }



    function updateTag($data, $id)

    {

        $this->db->where('tagID', $id);

        $this->db->update('tbl_cyberits_s_articles_tags', $data);

        $result = $this->db->affected_rows();

        return $result;

    }



    function deleteArticleTag($articleID, $tagID){

        $this->db->where('articleID', $articleID);

        $this->db->where('tagID', $tagID);

        $this->db->delete('tbl_cyberits_s_articles_tags');

    }



}

?>