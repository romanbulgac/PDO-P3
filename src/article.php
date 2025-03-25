<?php
class Article
{
    public int $id;
    public string $title;
    public string $subtitle;
    public string $article;
    public string $category;
    public string $author;
    public string $image;
    public string $date;
    private static function generateUniqueId(): int
    {
        $id = 0;
        do {
            $id = rand(100000, 999999);
        } while (self::exists($id));
        return $id;
    }

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->loadArticle();
    }

    private function loadArticle(): void
    {
        $xml_data = simplexml_load_file("articles.xml") or die("Failed to load");
        $row = $xml_data->xpath("//article[id='$this->id']")[0];

        if (!$row) {
            throw new Exception("Articolul nu exista");
        }

        $this->title = $row->title;
        $this->subtitle = $row->subtitle;
        $this->article = $this->readFile($this->id);
        $this->category = $row->category;
        $this->author = $row->author;
        $this->image = $row->image;
        $this->date = $row->date;
    }

    private static function writeFile(string $data, int $id): string
    {
        $filePath = "./assets/articles/{$id}.txt";
        file_put_contents($filePath, $data);
        return $filePath;
    }

    private static function readFile(int $dataId): string
    {
        $filePath = "./assets/articles/{$dataId}.txt";
        return file_exists($filePath) ? file_get_contents($filePath) : '';
    }

    public static function upload(
        string $title,
        string $subtitle,
        string $article,
        string $category,
        string $image,
        string $author
    ) {

        $id = self::generateUniqueId();
        $articlePath = self::writeFile($article, $id);
        $xml_data = simplexml_load_file("articles.xml") or die("Failed to load");
        $newItem = $xml_data->addChild('article');
        $newItem->addChild('id', $id);
        $newItem->addChild('title', $title);
        $newItem->addChild('subtitle', $subtitle);
        $newItem->addChild('category', $category);
        $newItem->addChild('author', $author);
        $newItem->addChild('image', $image);
        $newItem->addChild('date', date('Y-m-d'));
        file_put_contents('articles.xml', $xml_data->asXML());
        return $id;

    }

    public function edit(
        string $title,
        string $subtitle,
        string $article,
        string $category,
        string $image,
        string $author
    ): void {
            $articlePath = self::writeFile($article, $this->id);
            $xml_data = simplexml_load_file("articles.xml") or die("Failed to load");
            $item = $xml_data->xpath("//article[id=$this->id]")[0];
            $item->title = $title;
            $item->subtitle = $subtitle;
            $item->category = $category;
            $item->author = $author;
            $item->image = $image;
            file_put_contents('articles.xml', $xml_data->asXML());
            $this->loadArticle();
    }

    public static function exists($id): bool
    {
        $xml_data = simplexml_load_file("articles.xml") or die("Failed to load");
        $item = $xml_data->xpath("//article[id='$id']");
        return !empty($item);
    }


    public function delete(): void
    {
        $xml_data = simplexml_load_file("articles.xml") or die("Failed to load");
        $item = $xml_data->xpath("//article[id=$this->id]")[0];
        unlink("./assets/articles/{$this->id}.txt");
        unlink($item->image);

        unset($item[0]);
        file_put_contents('articles.xml', $xml_data->asXML());
    }
}
