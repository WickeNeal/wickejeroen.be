export interface Project {
    id: string;
    slug: string;
    title: string;
    description: string;
    coverImage: string;
    images: string[];
}

const basePath = import.meta.env.PROD ? '/wickejeroen.be' : '';

const getPath = (filename: string) => `${basePath}/images/mooiste foto's/${filename}`;

export const projects: Project[] = [
    {
        id: '1',
        slug: 'totaalrenovatie-gent',
        title: 'Totaalrenovatie Gent',
        description: 'Een volledige renovatie van een herenhuis in het centrum van Gent.',
        coverImage: getPath('20170814_114439.jpg'),
        images: [
            getPath('20170814_114439.jpg'),
            getPath('IMG_20200310_080808.jpg'),
            getPath('IMG_20200326_112935.jpg'),
        ]
    },
    {
        id: '2',
        slug: 'badkamer-renovatie',
        title: 'Luxe Badkamer',
        description: 'Modernisering van een badkamer met inloopdouche en maatkasten.',
        coverImage: getPath('IMG_20191121_164606 1.jpg'),
        images: [
            getPath('IMG_20191121_164606 1.jpg'),
            getPath('IMG_20200124_134219 1.jpg'),
        ]
    },
    {
        id: '3',
        slug: 'keuken-project',
        title: 'Keuken op Maat',
        description: 'Ontwerp en plaatsing van een moderne open keuken.',
        coverImage: getPath('IMG_20190828_141341 1.jpg'),
        images: [
            getPath('IMG_20190828_141341 1.jpg'),
            getPath('IMG_20210320_131124.jpg'),
        ]
    }
];

export const getProjectBySlug = (slug: string): Project | undefined => {
    return projects.find(p => p.slug === slug);
};
