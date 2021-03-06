<?php

require_once('Node.php');

/**
 * Class SingleLinkList
 * 单链接的实现示例，实现简单的填加，插入，删除, 查询，长度，遍历这几个简单操作
 */
class SingleLinkList
{
    /**
     * 链表头结点，头节点必须存在
     * @var Node
     */
    private $dummyHead;
    private $tail;

    private $size = 0;

    /**
     * 构造函数，默认填加一个哨兵节点 DummyHead，该节点元素为空
     * SingleLinkList constructor.
     */
    public function __construct()
    {
        $node = new Node(null);
        $this->dummyHead = $node;
        $this->tail = $node;
    }

    /**
     * 在链表末尾添加节点
     * @param Node $node
     * @return int
     */
    public function addLast(Node $node)
    {
//        $current = $this->dummyHead;
//        while ($current->next != null) {
//            $current = $current->next;
//        }
//        $current->next = $node;
        $this->tail->next = $node;
        $this->tail = $node;

        return ++$this->size;
    }

    public function getTail()
    {
        return 'tail data: ' . $this->tail->data;
    }

    /**
     * 在指定位置插入节点
     * @param int $index 节点位置，从 1 开始计数
     * @param Node $node
     * @return int
     * @throws Exception
     */
    public function insertNodeByIndex(int $index, Node $node)
    {
        if ($index < 1 || $index > ($this->size + 1)) {
            throw new Exception(sprintf('你要插入的位置，超过了链表的长度 %d', $this->size));
        }

        $current = $this->dummyHead;
        $currentIndex = 1;
        do {
            if ($index == $currentIndex) {
                $node->next = $current->next;
                $current->next = $node;
                if ($index == $this->size + 1) {
                    // 尾部添加
                    $this->tail = $node;
                }
                break;
            }
            $currentIndex++;
        } while ($current->next != null && ($current = $current->next));

        return ++$this->size;
    }

    /**
     * 删除节点
     * @param int $index 节点位置，从1开始计数
     * @return int
     * @throws Exception
     */
    public function deleteNodeByIndex(int $index)
    {
        if ($index < 1 || $index > ($this->size + 1)) {
            throw new Exception('你删除的节点不存在');
        }

        $current = $this->dummyHead;
        $currentIndex = 1;
        do {
            if ($index == $currentIndex) {
                $current->next = $current->next->next;
                break;
            }
            $currentIndex++;
        } while ($current->next != null && ($current = $current->next));

        return --$this->size;
    }

    /**
     * 查询节点
     * @param int $index 节点位置，从1开始计数
     * @return Node|null
     * @throws Exception
     */
    public function searchNodeByIndex(int $index)
    {
        if ($index < 1 || $index > ($this->size + 1)) {
            throw new Exception('你查询的节点不存在');
        }

        $current = $this->dummyHead;
        $currentIndex = 1;
        do {
            if ($index == $currentIndex) {
                return $current->next;
            }
            $currentIndex++;
        } while ($current->next != null && ($current = $current->next));
        return null;
    }

    /**
     * 获取节点长度
     * @return int
     */
    public function getLength()
    {
        return $this->size;
    }

    /**
     * 遍历列表
     */
    public function showNode()
    {
        $current = $this->dummyHead;
        $index = 1;
        while ($current->next != null) {
            $current = $current->next;
            echo 'index --- ' . $index++ . ' --- ';
            echo sprintf('data: %d', $current->data);
            echo PHP_EOL;
        }
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }
}
