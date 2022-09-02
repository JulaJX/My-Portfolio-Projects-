const ProjectDetails = (props) => {
    const id = props.match.params.id;
    return ( 
        <div className="container section project-details">
            <div className="card z-depth-0">
                <div className="card-content">
                    <span className="card-title">Project Title - {id}</span>
                    <div className="p">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum nobis libero natus, provident porro nemo culpa unde cum eum eaque!</div> 
                </div>
                <div className="card-action grey lighten-4 grey-text">
                    <div>Posted by Julek</div>
                    <div>2nd of September, 2am</div>
                </div>
            </div>
        </div>
     );
}
 
export default ProjectDetails;